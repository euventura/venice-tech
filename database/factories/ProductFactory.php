<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'slug' => fake()->slug(),
            'image' => fake()->imageUrl(640, 480, 'Product Image', true, 'Product Name'),
            'description' => fake()->paragraph(),
            'category_id' => Category::factory(),
            'brand_id' => Brand::factory()
        ];
    }
}
