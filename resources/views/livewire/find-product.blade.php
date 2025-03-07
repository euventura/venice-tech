<div class="p-6">
    <flux:heading size="xl" class="mb-8">Products Search</flux:heading>
    <div class="mb-6 space-y-4">
        <!-- Search Input -->
        <div>
            <flux:input placeholder="Find a Product by name" wire:model.live.debounce.200ms="search" />

        </div>

        <div>
            <!-- Category Filter -->
            <flux:dropdown>
                <flux:button icon-trailing="chevron-down">Categories</flux:button>
                <flux:menu>
                    @foreach($categories as $category)
                        <flux:checkbox wire:model.live="selectedCategories" value="{{ $category->id }}"
                            label=" {{ $category->name }}" class="mb-2" />
                    @endforeach
                </flux:menu>
            </flux:dropdown>

            <!-- Brand Filter -->
            <flux:dropdown>
                <flux:button icon-trailing="chevron-down">Brands</flux:button>
                <flux:menu>
                    @foreach($brands as $brand)
                        <flux:checkbox wire:model.live="selectedBrands" value="{{ $brand->id }}" label=" {{ $brand->name }}"
                            class="mb-2" />
                    @endforeach
                </flux:menu>
            </flux:dropdown>

            <flux:button variant="danger" class="float-end" wire:click="cleanFilters">Clean Filters</flux:button>
        </div>

        <!-- Selected Filters Summary -->
        <div class="flex flex-wrap gap-2 mt-6 mb-6">
            @foreach($selectedCategories as $categoryId)
                @php $category = $categories->find($categoryId) @endphp
                @if($category)
                    <span
                        class="inline-flex items-center rounded-full bg-blue-100 px-3 py-1 text-sm font-medium text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                        {{ $category->name }}
                        <button
                            wire:click="$set('selectedCategories', {{ json_encode(array_values(array_diff($selectedCategories, [$categoryId]))) }})"
                            class="ml-1 inline-flex h-4 w-4 items-center justify-center rounded-full hover:bg-blue-200 dark:hover:bg-blue-800">
                            ×
                        </button>
                    </span>
                @endif
            @endforeach

            @foreach($selectedBrands as $brandId)
                @php $brand = $brands->find($brandId) @endphp
                @if($brand)
                    <span
                        class="inline-flex items-center rounded-full bg-green-100 px-3 py-1 text-sm font-medium text-green-800 dark:bg-green-900 dark:text-green-200">
                        {{ $brand->name }}
                        <button
                            wire:click="$set('selectedBrands', {{ json_encode(array_values(array_diff($selectedBrands, [$brandId]))) }})"
                            class="ml-1 inline-flex h-4 w-4 items-center justify-center rounded-full hover:bg-green-200 dark:hover:bg-green-800">
                            ×
                        </button>
                    </span>
                @endif
            @endforeach

        </div>
    </div>

    <!-- Products Grid -->
    <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
        @forelse($products as $product)
            <div
                class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
                <img src="{{ $product->image }}" alt="{{ $product->name }}" class="h-48 w-full object-cover">
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $product->name }}</h3>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">{{ $product->description }}</p>
                    <div class="mt-4 flex flex-wrap gap-2">
                        <span
                            class="inline-flex items-center rounded-full bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                            {{ $categories->find($product->category_id)->name }}
                        </span>
                        <span
                            class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800 dark:bg-green-900 dark:text-green-200">
                            {{ $brands->find($product->brand_id)->name }}
                        </span>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-3 text-center">
                <p class="text-gray-500 dark:text-gray-400">No products found matching your criteria.</p>
            </div>
        @endforelse
    </div>
    <div class="mt-7">
        {{ $products->links() }}
    </div>
</div>