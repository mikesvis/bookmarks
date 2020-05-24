<?php

namespace App\Helpers;

class Search
{
    /**
     * Закладки
     *
     * @var App\Models\Bookmark
     */
    public $bookmarks;

    /**
     * Строка поиска
     *
     * @var string
     */
    public $searchString;

    /**
     * Слова из строки поиска
     *
     * @var array
     */
    public $words = [];

    public function __construct($bookmarks, $search)
    {
        $this->bookmarks = $bookmarks;
        $this->searchString = $search;

        $searchPhrase = preg_replace('!\s+!', ' ', trim($this->searchString));
        $this->words = array_map('trim', explode(' ', $searchPhrase));

        foreach ($this->words as $word) {
            $this->bookmarks = $this->bookmarks->where(function ($query) use($word) {
                $query->where('url', 'like', '%'.$word.'%')
                      ->orWhere('title', 'like', '%'.$word.'%')
                      ->orWhere('description', 'like', '%'.$word.'%')
                      ->orWhere('keywords', 'like', '%'.$word.'%');
            });
        }
    }
}
