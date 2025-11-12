@extends('customer.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-md p-6">
        <div class="text-center mb-6">
            <div class="inline-block p-3 bg-green-100 rounded-full mb-3">
                <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">Pesanan Berhasil!</h2>
            <p class="text-gray-600 mt-2">Order ID: #{{ $order->id }}</p>
        </div>

        <div class="border-t border-b py-4 mb-6">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-600 text-sm">Tanggal Pesanan</p>
                    <p class="font-medium">{{ $order->order_date->format('d M Y H:i') }}</p>
                </div>
                <div class="text-right">
                    <p class="text-gray-600 text-sm px-3 py-1">Status</p>
                    <span class="inline-block px-3 py-1 rounded-full text-sm font-medium
                        @if($order->status == 'proses') bg-yellow-100 text-yellow-800
                        @elseif($order->status == 'dikirim') bg-blue-100 text-blue-800
                        @else bg-green-100 text-green-800
                        @endif">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>
            </div>
        </div>

        <div class="mb-6">
            <h3 class="font-semibold text-lg mb-4">Detail Pesanan:</h3>
            
            @foreach($order->items as $item)
            <div class="flex justify-between items-center p-4 bg-gray-50 rounded-lg mb-3">
                <div>
                    <h4 class="font-medium">{{ $item->product->name }}</h4>
                    <p class="text-gray-600 text-sm">
                        Rp {{ number_format($item->price, 0, ',', '.') }} x {{ $item->quantity }}
                    </p>
                </div>
                <div class="font-semibold">
                    Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                </div>
            </div>
            @endforeach
        </div>

        <div class="border-t pt-4 mb-6">
            <div class="flex justify-between items-center text-xl font-bold">
                <span>Total:</span>
                <span class="text-blue-600">
                    Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                </span>
            </div>
        </div>

        <div class="flex gap-3">
            <a href="#" 
               class="flex-1 px-6 py-3 bg-gray-200 text-gray-700 rounded-lg text-center hover:bg-gray-300">
                Lihat Semua Pesanan
            </a>
            <a href="{{ route('customer.home') }}" 
               class="flex-1 px-6 py-3 bg-blue-600 text-white rounded-lg text-center hover:bg-blue-700">
                Lanjut Belanja
            </a>
        </div>
    </div>
</div>
@endsection