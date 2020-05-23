<?php

namespace App\Rules;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Validation\Rule;

class PageUnique implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $url = parse_url($value);

        // почему-то до этой строчки проходит проверка laravel адреса httsdasdp://mail.rus
        // нижняя строка для точной проверки при формировании baseUrl
        if(!isset($url['scheme']) && !isset($url['host']))
            return false;

        $baseUrl = $url['scheme']."://".$url['host'];

        $compareUrl = $value;

        if(rtrim($value, "/") == $baseUrl)
            $compareUrl = $baseUrl."/";

        return DB::table('bookmarks')->where('url', $compareUrl)->count() == 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.custom.url.page-not-unique');
    }
}
