<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class BookmarkExportCollection implements FromCollection, WithMapping, WithHeadings
{
    /**
     * Bookmarks
     *
     * @var array
     */
    public $bookmarks;

    public function __construct($bookmarks)
    {
        $this->bookmarks = $bookmarks;
    }

    /**
     * Мапер
     *
     * @param [type] $user
     * @return array
     */
    public function map($bookmark): array
    {
        return [
            $bookmark->created_at,
            $bookmark->url,
            $bookmark->title,
            $bookmark->keywords,
            $bookmark->description,
        ];
    }

    /**
     * Заголовки
     *
     * @return array
     */
    public function headings() : array
    {
        return [
            'Дата',
            'URL',
            'Заголовок',
            'Keywords',
            'Description',
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->bookmarks->get();
    }
}
