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
            'image' => fake()->imageUrl(640, 480, 'Product', true),
            'description' => fake()->paragraph(),
            'category_id' => function (array $attr) {
                $category = Category::find(1);
                if (! $category) {
                    return Category::factory();
                }

                return $category;
            },
            'brand_id' => function (array $attr) {
                $brand = Brand::find(1);
                if (! $brand) {
                    return Brand::factory();
                }

                return $brand;
            },
        ];
    }
}
