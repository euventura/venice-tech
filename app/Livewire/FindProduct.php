<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\Session;
use Livewire\Component;

class FindProduct extends Component
{
    #[Session]
    public $search = '';
    #[Session]
    public $selectedCategories = [];
    #[Session]
    public $selectedBrands = [];


    public function render()
    {
        $products = Product::query()
            ->when(!empty($this->selectedCategories), function ($query) {
                $query->whereIn('category_id', $this->selectedCategories);
            })
            ->when(!empty($this->selectedBrands), function ($query) {
                $query->whereIn('brand_id', $this->selectedBrands);
            })
            ->when($this->search, function ($query) {
                $query->whereLike('name',  '%' . $this->search . '%', false);
            })
            ->paginate(20);

        return view('livewire.find-product', [
            'products' => $products,
            'categories' => Category::all(),
            'brands' => Brand::all(),
        ]);
    }

    public function cleanFilters()
    {
        $this->search = '';
        $this->selectedCategories = [];
        $this->selectedBrands = [];
    }
}
