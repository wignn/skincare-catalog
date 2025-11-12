@extends('customer.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold mb-6">Pesan Produk</h2>

        <div class="mb-6 p-4 bg-gray-50 rounded-lg">
            <div class="flex gap-4">
                @if($product->image)
                <img src="{{ asset(path: $product->image_url) }}"
                     alt="{{ $product->name }}" 
                     class="w-24 h-24 object-cover rounded">
                @endif
                <div>
                    <h3 class="font-semibold text-lg">{{ $product->name }}</h3>
                    <p class="text-gray-600">{{ $product->description }}</p>
                    <p class="text-xl font-bold text-blue-600 mt-2">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </p>
                </div>
            </div>
        </div>

        <form action="{{ route('orders.store-direct', $product->id) }}" method="POST" id="orderForm">
  
            @csrf
            
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Jumlah</label>
                <input type="number" 
                       name="quantity" 
                       value="1" 
                       min="1"
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       required>
                @error('quantity')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6 p-4 bg-blue-50 rounded-lg">
                <div class="flex justify-between items-center">
                    <span class="font-medium">Total:</span>
                    <span class="text-2xl font-bold text-blue-600" id="totalAmount">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </span>
                </div>
            </div>

            @if(session('error'))
                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex gap-3">
                <a href="{{ url()->previous() }}" 
                   class="flex-1 px-6 py-3 bg-gray-200 text-gray-700 rounded-lg text-center hover:bg-gray-300">
                    Batal
                </a>
                <button type="submit" 
                        id="submitBtn"
                        class="flex-1 px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 disabled:opacity-50">
                    <span id="btnText">Pesan Sekarang</span>
                    <span id="btnLoading" class="hidden">Memproses...</span>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.querySelector('input[name="quantity"]').addEventListener('input', function() {
    const quantity = this.value;
    const price = {{ $product->price }};
    const total = quantity * price;
    document.getElementById('totalAmount').textContent = 
        'Rp ' + total.toLocaleString('id-ID');
});

document.getElementById('orderForm').addEventListener('submit', function(e) {
    console.log('Form submitted!');
    const submitBtn = document.getElementById('submitBtn');
    const btnText = document.getElementById('btnText');
    const btnLoading = document.getElementById('btnLoading');
    
    submitBtn.disabled = true;
    btnText.classList.add('hidden');
    btnLoading.classList.remove('hidden');
});
</script>
@endsection