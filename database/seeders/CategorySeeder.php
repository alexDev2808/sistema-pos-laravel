<?php

namespace Database\Seeders;

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
        Category::create([
            'name' => 'Cursos',
            'image' => 'https://dummyimage.com/200x150/5c5657/fff'
        ]);
        Category::create([
            'name' => 'Tenis',
            'image' => 'https://dummyimage.com/200x150/5c5657/fff'
        ]);
        Category::create([
            'name' => 'Celulares',
            'image' => 'https://dummyimage.com/200x150/5c5657/fff'
        ]);
        Category::create([
            'name' => 'Computadoras',
            'image' => 'https://dummyimage.com/200x150/5c5657/fff'
        ]);
    }
}
