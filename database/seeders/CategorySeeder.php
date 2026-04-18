<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::create(['id' => 1, 'name' => 'Electronics']);
        Category::create(['id' => 2, 'name' => 'Clothing']);
        Category::create(['id' => 3, 'name' => 'Books']);
    }
}
