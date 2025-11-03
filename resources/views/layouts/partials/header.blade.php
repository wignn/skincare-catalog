<!-- User Profile -->
<div class="relative justify-end flex">
    <button id="user-menu-button" class="flex mx-2 my-2 flex items-center  gap-2 focus:outline-none">
        <div class="text-right hidden sm:block">
            <p class="text-sm font-semibold text-gray-800">{{ Auth::user()->name }}</p>
            <p class="text-xs text-gray-500">{{ Auth::user()->role }}</p>
        </div>
        <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-semibold hover:bg-blue-200 transition-colors">
            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
        </div>
        <svg class="w-4 h-4 text-gray-500 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
        </svg>
    </button>

    <!-- Dropdown Menu -->
    <div id="user-menu" class="hidden absolute top-10 right-0 mt-2 w-40 bg-white border border-gray-200 rounded-lg shadow-lg">
        <form action="{{ route('logout') }}" method="POST" class="block">
            @csrf
            <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
                Logout
            </button>
        </form>
    </div>
</div>

<script>
document.getElementById('user-menu-button').addEventListener('click', function () {
    document.getElementById('user-menu').classList.toggle('hidden');
});
</script>
