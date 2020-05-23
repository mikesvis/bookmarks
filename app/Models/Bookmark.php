<?php

namespace App\Models;

use Carbon\Carbon;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    use Sortable;

    public $sortable = [
        'created_at',
        'url',
        'title',
    ];

    public function getCreatedAtAttribute($value)
    {

        if(!empty($value))
            return Carbon::parse($value)->isoFormat('DD.MM.YYYY');

        return $value;

    }

}
