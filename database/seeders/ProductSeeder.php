<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        for ($i = 0; $i < 5; $i++) {
            Product::create([
            'title' => 'Product ' . $i,
            'slug' => 'product-' . $i,
            'description' => 'This product ' . $i . 'description',
            'price' => rand(999, 9999),
            ]);
        }
    }
}
