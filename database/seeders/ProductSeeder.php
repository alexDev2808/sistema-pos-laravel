<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'name' => 'Laravel y Livewire',
            'cost' => 200,
            'price' => 350,
            'barcode' => '456373664673',
            'stock' => 100,
            'alerts' => 10,
            'category_id' => 1,
            'image' => 'curso.png'
        ]);
        Product::create([
            'name' => 'Laravel y Angular',
            'cost' => 200,
            'price' => 450,
            'barcode' => '786373664673',
            'stock' => 100,
            'alerts' => 10,
            'category_id' => 1,
            'image' => 'curso.png'
        ]);
        Product::create([
            'name' => 'Puma',
            'cost' => 200,
            'price' => 350,
            'barcode' => '126373664673',
            'stock' => 100,
            'alerts' => 10,
            'category_id' => 2,
            'image' => 'tenis.png'
        ]);
    }
}
