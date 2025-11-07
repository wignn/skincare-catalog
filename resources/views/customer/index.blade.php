@extends('customer.layouts.app')

@section('title', 'Home - Mirglow')

@section('content')
  <!-- Hero Section -->
  <section class="bg-white py-20">
    <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row items-center gap-12">
      <div class="flex-1">
        <h1 class="text-4xl md:text-5xl font-bold leading-tight text-gray-900">
          Temukan <br>
          <span class="text-blue-600">Kecantikanmu</span> Sekarang
        </h1>
        <p class="text-gray-600 mt-4 max-w-md">
          Jelajahi produk skincare terbaik dari brand terpercaya dengan harga yang bersahabat.
        </p>
        <a href="{{ route('customer.products') }}"
           class="inline-block mt-6 bg-blue-600 text-white px-6 py-3 font-semibold rounded-lg hover:bg-blue-700 transition">
          Lihat Produk
        </a>
      </div>

      <div class="flex-1 flex justify-center">
        <div class="bg-gray-100 rounded-2xl shadow-md w-80 h-56 flex items-center justify-center text-gray-400">
          Gambar promo (sementara)
        </div>
      </div>
    </div>
  </section>

{{-- Featured Products --}}
<section class="py-20 bg-white">
  <div class="max-w-7xl mx-auto px-6 text-center">
    <h2 class="text-2xl font-semibold text-gray-900">Produk Unggulan</h2>
    <p class="text-gray-500 mt-2">Pilihan terbaik untuk perawatan kulitmu</p>

    <div class="mt-10 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-8">

      @forelse($featuredProducts as $product)
      <div class="group bg-white/90 backdrop-blur border border-gray-100 rounded-2xl overflow-hidden shadow-md hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 cursor-pointer">
        <div class="relative w-full h-52 bg-gray-100 overflow-hidden">
          <img src="{{ asset(path: $product->image_url) }}" alt="{{ $product->name }}"
               alt="{{ $product->name }}"
               class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
        </div>

        <div class="p-4 text-left">
          <h3 class="text-gray-800 font-semibold text-sm line-clamp-2">{{ $product->name }}</h3>
          <p class="text-blue-600 font-bold text-base mt-3">
            Rp{{ number_format($product->price, 0, ',', '.') }}
          </p>
          <p class="text-sm text-gray-500 mt-1">Terjual: {{ $product->total_sold }}</p>
        </div>
      </div>
      @empty
      <p class="text-gray-500 col-span-full">Belum ada produk unggulan.</p>
      @endforelse

    </div>
  </div>
</section>

{{-- Products Section --}}
<section class="py-12 bg-white">
  <div class="max-w-7xl mx-auto px-6">
    <h2 class="text-xl font-semibold text-gray-900 mb-6">Produk</h2>

    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-8">

      @foreach ($products as $product)
      <div class="group bg-white/90 backdrop-blur border border-gray-100 rounded-2xl overflow-hidden shadow-md hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 cursor-pointer">
        <div class="relative w-full h-48 bg-gray-100 overflow-hidden">
          <img src="{{ asset(path: $product->image_url) }}" alt="{{ $product->name }}"
               class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
        </div>

        <div class="p-4">
          <h3 class="text-gray-800 font-semibold text-sm line-clamp-2">{{ $product->name }}</h3>
          <p class="text-blue-600 font-bold text-base mt-3">
            Rp{{ number_format($product->price, 0, ',', '.') }}
          </p>
        </div>
      </div>
      @endforeach

    </div>

    {{-- Tombol Lihat Lebih Banyak --}}
    <div class="text-center mt-10">
      <a href="{{ route('customer.products') }}" class="text-blue-600 font-semibold hover:underline">Lihat Lebih Banyak →</a>
    </div>

  </div>
</section>

@endsection
