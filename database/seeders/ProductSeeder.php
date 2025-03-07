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
        Brand::factory()
            ->has(Product::factory()->count(5))
            ->count(10)
            ->create();

        Category::factory()
            ->has(Product::factory()->count(5))
            ->count(10)
            ->create();
    }
}
