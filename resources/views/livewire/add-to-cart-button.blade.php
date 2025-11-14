<div>
    @auth
        <button wire:click="addToCart" class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition hover:cursor-pointer">
            Tambah ke Keranjang
        </button>
    @else
        <a href="{{ route('login') }}" class="px-4 py-2 bg-gray-400 text-white rounded-lg hover:bg-gray-500 transition ">
            Login untuk Beli
        </a>
    @endauth
</div>