<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['label' => 'HTML'],
            ['label' => 'CSS'],
            ['label' => 'JS'],
            ['label' => 'VUE'],
            ['label' => 'LARAVEL']
        ];

        foreach ($categories as $category) {
            $c = new Category();
            $c->label = $category['label'];
            $c->save();
        }
    }
}
