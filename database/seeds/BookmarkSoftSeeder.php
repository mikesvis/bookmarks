<?php

use App\Models\Bookmark;
use Illuminate\Database\Seeder;

class BookmarkSoftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Bookmark::class, 50)->create();
    }
}
