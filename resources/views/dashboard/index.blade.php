@extends('layouts.dashboard')
@extends('layouts.add-product')

@section('content')
    <div class="p-4 sm:p-6">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-6 sm:mb-8">
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">Products</h1>
            <div class="flex gap-2 sm:gap-3">
                <button class="flex-1 sm:flex-none px-3 sm:px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 flex items-center justify-center gap-2 text-sm sm:text-base">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <span class="hidden sm:inline">Export</span>
                </button>
                <a href="{{ route('products.create') }}" class="flex-1 sm:flex-none px-3 sm:px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 flex items-center justify-center gap-2 text-sm sm:text-base">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span>Add Product</span>
                </a>
            </div>
        </div>

        <!-- Filter and Search Section -->
        <div class="bg-white rounded-xl sm:rounded-2xl border border-gray-200 mb-6">
            <div class="p-4 sm:p-6 border-b border-gray-200">
                <div class="flex flex-col gap-3 sm:gap-4">
                    <!-- Search -->
                    <div class="w-full">
                        <div class="relative">
                            <input type="text" 
                                   placeholder="Search products..." 
                                   class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                            <svg class="w-5 h-5 text-gray-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                    </div>
                    
                    <!-- Filters -->
                    <!-- <div class="flex flex-wrap gap-2 sm:gap-3">
                        <select class="flex-1 min-w-[120px] px-3 sm:px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                            <option>All Categories</option>
                            <option>Electronics</option>
                            <option>Fashion</option>
                            <option>Home & Kitchen</option>
                        </select>
                        
                        <select class="flex-1 min-w-[120px] px-3 sm:px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                            <option>All Status</option>
                            <option>Active</option>
                            <option>Draft</option>
                            <option>Out of Stock</option>
                        </select>

                        <button class="px-3 sm:px-4 py-2.5 border border-gray-300 rounded-lg hover:bg-gray-50">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                            </svg>
                        </button>
                    </div> -->
                </div>
            </div>

            <!-- Products Grid -->
            <div class="p-4 sm:p-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-6">
                    @foreach ($products as $product)
                        <div class="bg-white border border-gray-200 rounded-xl overflow-hidden hover:shadow-lg transition-shadow duration-300 group">
                            <!-- Product Image -->
                            <div class="relative overflow-hidden bg-gray-100 aspect-square">
                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" 
                                         alt="{{ $product->name }}"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <svg class="w-16 h-16 sm:w-20 sm:h-20 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                @endif
                                
                                <!-- Stock Badge -->
                                @if(isset($product->stock))
                                    @if($product->stock == 0)
                                        <span class="absolute top-2 right-2 sm:top-3 sm:right-3 bg-red-500 text-white text-xs font-semibold px-2 py-1 rounded-full">
                                            Out of Stock
                                        </span>
                                    @elseif($product->stock < 10)
                                        <span class="absolute top-2 right-2 sm:top-3 sm:right-3 bg-yellow-500 text-white text-xs font-semibold px-2 py-1 rounded-full">
                                            Low Stock
                                        </span>
                                    @endif
                                @endif
                            </div>

                            <!-- Product Info -->
                            <div class="p-3 sm:p-4">
                                <!-- Category -->
                                @if(isset($product->category))
                                    <span class="text-xs text-blue-600 font-medium uppercase tracking-wide">
                                        {{ $product->category }}
                                    </span>
                                @endif

                                <!-- Product Name -->
                                <h3 class="text-sm sm:text-base font-semibold text-gray-800 mt-2 line-clamp-2 min-h-[2.5rem] sm:min-h-[3rem]">
                                    {{ $product->name }}
                                </h3>

                                <!-- Description -->
                                <p class="text-xs sm:text-sm text-gray-500 mt-2 line-clamp-2">
                                    {{ $product->description ?? 'No description available' }}
                                </p>

                                <!-- Price and Stock -->
                                <div class="flex items-center justify-between mt-3 sm:mt-4 mb-3 sm:mb-4">
                                    <div>
                                        <span class="text-lg sm:text-xl font-bold text-gray-900">
                                            Rp {{ number_format($product->price, 0, ',', '.') }}
                                        </span>
                                        @if(isset($product->stock))
                                            <p class="text-xs text-gray-500 mt-1">Stock: {{ $product->stock }}</p>
                                        @endif
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex gap-2">
                                    <a href="{{ route('products.edit', $product->id) }}"
                                       class="flex-1 text-center px-3 sm:px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors text-xs sm:text-sm font-medium">
                                        Edit
                                    </a>

                                    <form action="{{ route('products.destroy', $product->id) }}" 
                                          method="POST" 
                                          class="flex-1"
                                          onsubmit="return confirm('Are you sure you want to delete this product?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="w-full px-3 sm:px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors text-xs sm:text-sm font-medium">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Empty State -->
                @if($products->isEmpty())
                    <div class="text-center py-12 sm:py-16">
                        <svg class="w-20 h-20 sm:w-24 sm:h-24 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                        <h3 class="text-lg sm:text-xl font-semibold text-gray-700 mb-2">No Products Yet</h3>
                        <p class="text-sm sm:text-base text-gray-500 mb-6 px-4">Start by adding your first product to the store</p>
                        <a href="{{ route('products.create') }}" 
                           class="inline-flex items-center gap-2 px-5 sm:px-6 py-2.5 sm:py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm sm:text-base">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Add Your First Product
                        </a>
                    </div>
                @endif
            </div>

            <!-- Pagination -->
            @if(is_object($products) && method_exists($products, 'hasPages') && $products->hasPages())
                <div class="px-4 sm:px-6 py-4 border-t border-gray-200 flex flex-col sm:flex-row items-center justify-between gap-3 sm:gap-0">
                    <div class="text-xs sm:text-sm text-gray-600 text-center sm:text-left">
                        Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of {{ $products->total() }} products
                    </div>
                    <div class="flex gap-2">
                        {{ $products->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
