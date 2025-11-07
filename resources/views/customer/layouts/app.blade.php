<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Exclusive')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  </head>

  <body class="font-sans bg-white text-gray-800">
    {{-- navbar --}}
    <nav class="border-b border-gray-100 bg-white">
      <div class="max-w-full mx-auto px-6 flex justify-between items-center h-16">
        {{-- Nama Brand --}}
        <a href="#" class="text-2xl font-bold text-blue-600">
          Mirglow
        </a>

        {{-- Link Navigasi --}}
        <div class="hidden md:flex items-center gap-8">
          <a href="{{ route('customer.home') }}" class="text-gray-700 hover:text-blue-600 transition">Home</a>
          <a href="{{ route('customer.products') }}" class="text-gray-700 hover:text-blue-600 transition">Products</a>
          <a href="#" class="text-gray-700 hover:text-blue-600 transition">About</a>
        </div>

        {{-- User Profile / Auth Section --}}
        <div class="flex items-center gap-4">
          @auth
            <div class="relative flex justify-end">
              <button id="user-menu-button" class="flex items-center gap-2 focus:outline-none">
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

              {{-- Dropdown --}}
              <div id="user-menu" class="hidden absolute top-12 right-0 mt-2 w-40 bg-white border border-gray-200 rounded-lg shadow-lg">
                <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profile</a>
                <form action="{{ route('logout') }}" method="POST" class="block">
                  @csrf
                  <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
                    Logout
                  </button>
                </form>
              </div>
            </div>
          @else
            <a href="{{ route('login') }}" class="text-sm text-blue-600 font-medium hover:underline">Login</a>
          @endauth
        </div>
      </div>
    </nav>

    {{-- content --}}
    <main>
      @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="border-t border-gray-100 mt-16">
      <div class="max-w-7xl mx-auto px-6 py-8 text-center text-sm text-gray-500">
        © {{ date('Y') }} Exclusive. All rights reserved.
      </div>
    </footer>

    {{-- Dropdown Script --}}
    <script>
      const userMenuBtn = document.getElementById('user-menu-button');
      const userMenu = document.getElementById('user-menu');
      if (userMenuBtn && userMenu) {
        userMenuBtn.addEventListener('click', () => {
          userMenu.classList.toggle('hidden');
        });
      }
    </script>
  </body>
</html>
