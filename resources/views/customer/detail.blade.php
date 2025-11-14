@extends('customer.layouts.app')

@section('title', $product->name . ' - Detail Produk')

@section('content')
<div class="max-w-5xl mx-auto px-6 py-12">
  <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
    <div class="rounded-lg overflow-hidden shadow-lg">
      <img src="{{ asset($product->image_url) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
    </div>

    <div>
      <h1 class="text-3xl font-semibold text-gray-800">{{ $product->name }}</h1>
      <p class="text-blue-600 text-2xl font-bold mt-3">
        Rp{{ number_format($product->price, 0, ',', '.') }}
      </p>
      <p class="text-gray-600 mt-4">{{ $product->description ?? 'Deskripsi belum tersedia.' }}</p>

      <div class="mt-6">
        {{-- <a href="#" class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">Tambah ke Keranjang</a> --}}
        @livewire('add-to-cart-button', ['product' => $product], key($product->id))
      </div>
    </div>
  </div>
</div>
@endsection
