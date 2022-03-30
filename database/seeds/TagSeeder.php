<?php

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            ['name' => 'FrontEnd', 'color' => '#2d9a8c'], // azzurro
            ['name' => 'BackEnd', 'color' => '#c111d1'], // viola
            ['name' => 'FullStack', 'color' => '#e5dc14'], // giallo
        ];

        foreach ($tags as $tag) {
            $t = new Tag();
            $t->name = $tag['name'];
            $t->color = $tag['color'];
            $t->save();
        }
    }
}
