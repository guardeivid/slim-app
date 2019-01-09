<?php

namespace App\database\seeds;

use SlimApp\Artisan\Seeder;
use App\Models\Post;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = [
            ["nombre" => "Primer Post"],
            ["nombre" => "Segundo Post"],
            ["nombre" => "Tercero Post"],
        ];

        for ($i=0; $i<5; $i++){
            Post::create(['nombre' =>  'Post ' . $i]);
        }

    }
}
