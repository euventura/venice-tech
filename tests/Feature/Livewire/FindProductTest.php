<?php

namespace Tests\Feature\Livewire;

use App\Livewire\FindProduct;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Database\Seeders\ProductSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class FindProductTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function first_product_showed()
    {
        $user = User::factory()->create();
        $this->seed(ProductSeeder::class);
        $product = Product::find(1);

        Livewire::actingAs($user)
            ->test(FindProduct::class)
            ->assertSee($product->name);
    }

    #[Test]
    public function category_filter()
    {
        $user = User::factory()->create();
        $this->seed(ProductSeeder::class);
        $category = Category::with('products')->find(2);

        Livewire::actingAs($user)
            ->test(FindProduct::class, ['selectedCategories' => [$category->id]])
            ->assertSee($category->products()->first()->name);
    }

    #[Test]
    public function brands_filter()
    {
        $user = User::factory()->create();
        $this->seed(ProductSeeder::class);
        $brand = Brand::with('products')->find(2);

        Livewire::actingAs($user)
            ->test(FindProduct::class, ['selectedBrands' => [$brand->id]])
            ->assertSee($brand->products()->first()->name);
    }

    #[Test]
    public function search_filter()
    {
        $user = User::factory()->create();
        $this->seed(ProductSeeder::class);
        $product = Product::find(1);

        Livewire::actingAs($user)
            ->test(FindProduct::class, ['search' => substr($product->name, 0, 10)])
            ->assertSee($product->name);
    }

    #[Test]
    public function clean_filters()
    {
        $user = User::factory()->create();
        $this->seed(ProductSeeder::class);
        $product = Product::find(1);

        Livewire::actingAs($user)
            ->test(FindProduct::class, ['search' => 'a', 'selectedBrands' => [''], 'selectedCategories' => ['1']])
            ->call('cleanFilters')
            ->assertSet('search', value: '')
            ->assertSet('selectedBrands', value: [])
            ->assertSet('selectedCategories', value: []);
    }
}
