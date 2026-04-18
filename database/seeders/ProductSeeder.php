<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Electronics category_id = 1
        Product::create([
            'name' => 'Laptop',
            'description' => 'High performance laptop for work and gaming.',
            'price' => 1000,
            'stock' => 10,
            'category_id' => 1,
            'image' => null // optional, or put image filename if exists
        ]);

        Product::create([
            'name' => 'Smartphone',
            'description' => 'Latest smartphone with great camera.',
            'price' => 700,
            'stock' => 20,
            'category_id' => 1,
            'image' => null
        ]);

        // Clothing category_id = 2
        Product::create([
            'name' => 'T-Shirt',
            'description' => 'Cotton t-shirt, comfortable and stylish.',
            'price' => 20,
            'stock' => 50,
            'category_id' => 2,
            'image' => null
        ]);

        Product::create([
            'name' => 'Jeans',
            'description' => 'Blue denim jeans for everyday wear.',
            'price' => 40,
            'stock' => 30,
            'category_id' => 2,
            'image' => null
        ]);

        // Books category_id = 3
        Product::create([
            'name' => 'Laravel Guide',
            'description' => 'Learn Laravel step by step.',
            'price' => 30,
            'stock' => 15,
            'category_id' => 3,
            'image' => null
        ]);

        Product::create([
            'name' => 'PHP Cookbook',
            'description' => 'Practical PHP solutions for everyday tasks.',
            'price' => 25,
            'stock' => 20,
            'category_id' => 3,
            'image' => null
        ]);
    }
}
