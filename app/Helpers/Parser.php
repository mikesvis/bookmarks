<?php

namespace App\Helpers;

class Parser
{

    /**
     * Url страницы реурса
     *
     * @var string
     */
    public $pageUrl = '';

    /**
     * Base url сайта
     *
     * @var string
     */
    public $baseUrl;

    /**
     * Содержимое ресурса для парсинга
     *
     * @var string
     */
    public $rawSource = null;

    /**
     * Содержимое ресурса для парсинга, записанное в временный файл
     *
     * @var string
     */
    public $rawSourceFile = null;

    /**
     * Свойства после парсинга
     *
     * @var array
     */
    public $data = [];

    public function __construct($pageUrl)
    {
        $this->pageUrl = $pageUrl;

        $this->rawSource = $this->getHtml();

        $this->rawSourceFile = tmpfile();
        fwrite($this->rawSourceFile, $this->rawSource);

        $url = parse_url($this->pageUrl);
        $this->baseUrl = $url['scheme']."://".$url['host'];

        $this->parse();

        fclose($this->rawSourceFile);
    }

    /**
     * Нормализация Url
     *
     * @param string $pageUrl
     * @return string
     */
    public static function normalizeUrl($pageUrl, $test = false)
    {
        $curlHandle = curl_init();
        curl_setopt($curlHandle, CURLOPT_URL, $pageUrl);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curlHandle, CURLOPT_FOLLOWLOCATION, true);
        curl_exec($curlHandle);
        $responseHeaders = curl_getinfo($curlHandle);

        if(in_array($responseHeaders['http_code'], [200, 301, 302])) {
            return $responseHeaders['url'];
        }

        return null;

    }

    /**
     * Получаем сожеджимое страницы
     *
     * @return string сожеджимое страницы
     */
    public function getHtml()
    {
        $curlHandle = curl_init();
        curl_setopt($curlHandle, CURLOPT_URL, $this->pageUrl);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($curlHandle);

        return $response;
    }

    /**
     * Собираем данные в масси $data
     *
     * @return void
     */
    public function parse()
    {
        $this->data['favicon'] = $this->getFavicon();
        $this->data['title'] = $this->getTag('title');
        $this->data['keywords'] = $this->getMetaTag('keywords');
        $this->data['description'] = $this->getMetaTag('description');
    }

    /**
     * Получаем значение поля из данных
     *
     * @param string $field Ключ поля в массиве $data
     * @return mixed|null Значение поля $data[$field]
     */
    public function getData($field)
    {
        return $this->data[$field] ?? null;
    }

    /**
     * Получение адреса favicon
     *
     * @return string
     */
    public function getFavicon()
    {
        $path = $this->baseUrl.'/favicon.ico';

        return self::normalizeUrl($path);
    }

    /**
     * Получаем значение тэга
     *
     * @param string $tag интересующий нас тэг
     * @return string
     */
    public function getTag($tag)
    {
        $result = null;

        $pattern = "/<$tag.*?>(.*?)<\/$tag>/is";

        $matches = [];

        preg_match_all($pattern, $this->rawSource, $matches);

        $result = $matches[1][0] ?? null;

        return $result;
    }

    /**
     * Получаем значение мета тэга
     *
     * @param string $meta интересующий нас мета тэг
     * @return string
     */
    public function getMetaTag($meta)
    {
        $result = null;

        $tags = get_meta_tags(stream_get_meta_data($this->rawSourceFile)['uri']);

        $result = $tags[$meta] ?? null;

        return $result;
    }

    /**
     * Получаем значение url c "/" если берем главную страницу
     *
     * @return string
     */
    public function getUrl()
    {
        return (rtrim($this->pageUrl,'/') == $this->baseUrl) ? $this->baseUrl.'/' : $this->pageUrl;
    }

}

?>
