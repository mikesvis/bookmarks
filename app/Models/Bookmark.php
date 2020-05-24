<?php

namespace App\Models;

use Carbon\Carbon;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    use Sortable;

    /**
     * Поля для сортировки
     *
     * @var array
     */
    public $sortable = [
        'created_at',
        'url',
        'title',
    ];

    /**
     * Accessor для даты
     *
     * @param string $value
     * @return string
     */
    public function getCreatedAtDateAttribute()
    {
        if(!empty($this->created_at))
            return Carbon::parse($this->created_at)->isoFormat('DD.MM.YYYY');

        return $this->created_at;
    }

    /**
     * Accessor для даты и времени
     *
     * @param string $value
     * @return string
     */
    public function getCreatedAtDateTimeAttribute()
    {
        if(!empty($this->created_at))
            return Carbon::parse($this->created_at)->isoFormat('HH:mm DD.MM.YYYY');

        return $this->created_at;
    }

    /**
     * Accessor для заголовка
     *
     * @param string $value
     * @return string
     */
    public function getTitleAttribute($value)
    {
        if(empty($value)){
            return 'У страницы не найден тег title';
        }

        return $value;
    }

    /**
     * Accessor для keywords
     *
     * @param string $value
     * @return string
     */
    public function getKeywordsAttribute($value)
    {
        if(empty($value)){
            return 'У страницы не найден мета тег keywords';
        }

        return $value;
    }

    /**
     * Accessor для description
     *
     * @param string $value
     * @return string
     */
    public function getDescriptionAttribute($value)
    {
        if(empty($value)){
            return 'У страницы не найден мета тег description';
        }

        return $value;
    }

}
