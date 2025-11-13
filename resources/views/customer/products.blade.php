@extends('customer.layouts.app')

@section('title', 'Products - Mirglow')

@section('content')
<section class="py-20 bg-white">
  <div class="max-w-7xl mx-auto px-6">

    <h1 class="text-3xl font-semibold text-gray-900 text-center">Semua Produk</h1>
    <p class="text-gray-500 text-center mt-2">Temukan produk skincare terbaik untukmu</p>

    <div class="mt-12 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-8">

      @foreach ($products as $product)
        <a href="{{ route('customer.product.detail', $product->id) }}">
            <div class="group bg-white/90 backdrop-blur border border-gray-100 rounded-2xl overflow-hidden shadow-md hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 cursor-pointer">
                <div class="relative w-full h-52 bg-gray-100 overflow-hidden">
                <img src="{{ asset($product->image_url) }}" alt="{{ $product->name }}"
                    alt="{{ $product->name }}"
                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                </div>

                <div class="p-4">
                <h3 class="text-gray-800 font-semibold text-sm line-clamp-2">{{ $product->name }}</h3>
                <p class="text-blue-600 font-bold text-base mt-3">
                    Rp{{ number_format($product->price, 0, ',', '.') }}
                </p>
                </div>
            </div>
        </a>
      @endforeach

    </div>

    <!-- Pagination -->
    <div class="mt-12">
      {{ $products->links() }}
    </div>

  </div>
</section>
@endsection
