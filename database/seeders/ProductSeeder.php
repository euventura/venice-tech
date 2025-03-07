<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::truncate();
        Brand::truncate();
        Product::truncate();

        Category::factory()->count(1)->create();
        Brand::factory()
            ->has(Product::factory()->count(20))
            ->count(5)
            ->create();

        Category::factory()
            ->has(Product::factory()->count(20))
            ->count(5)
            ->create();
    }
}
