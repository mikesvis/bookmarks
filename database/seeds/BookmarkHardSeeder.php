<?php

use App\Models\Bookmark;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookmarkHardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::disableQueryLog();
        $faker = \Faker\Factory::create();

        for ($i=0; $i < 1000; $i++) {
            $fakers[] = [
                'url' => $faker->url,
                'title' => $faker->sentence($nbWords = 5),
                'description' => $faker->sentence,
                'keywords' => $faker->words($nb = 5, $asText = true),
                'favicon' => null,
                'password' => (bool)rand(0, 1) ? null : Hash::make('password'), // password,
                'created_at' => $faker->dateTimeThisYear()->format("Y-m-d H:i:s")
            ];
        }

        $total = count($fakers);

        for ($i=0; $i < 100000; $i++) {
            $item = [
                'url' => $fakers[rand(0, $total - 1)]['url'],
                'title' => $fakers[rand(0, $total - 1)]['title'],
                'description' => $fakers[rand(0, $total - 1)]['description'],
                'keywords' => $fakers[rand(0, $total - 1)]['keywords'],
                'favicon' => null,
                'password' => $fakers[rand(0, $total - 1)]['password'],
                'created_at' =>$fakers[rand(0, $total - 1)]['created_at'],
            ];
            $data[] = $item;
        }


        $chunks = array_chunk($data, 1000);

        foreach ($chunks as $chunk) {
            Bookmark::insert($chunk);
        }

    }
}
