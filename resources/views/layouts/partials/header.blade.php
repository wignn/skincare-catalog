<!-- Top Header -->
<header class="bg-white border-b border-gray-200">
    <div class="px-6 py-4 flex items-center justify-between">
        <!-- Hamburger Menu Button (Mobile) -->
        <button id="sidebar-toggle" class="lg:hidden p-2 rounded-lg hover:bg-gray-100 transition-colors">
            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>

        <!-- Page Title (Desktop) -->
        <div class="hidden lg:block">
            <h2 class="text-xl font-semibold text-gray-800">Dashboard</h2>
        </div>

        <!-- Right Side -->
        <div class="flex items-center gap-4 ml-auto">
            <!-- User Profile -->
            <div class="flex items-center gap-3 pl-4 border-l border-gray-200">
                <div class="text-right hidden sm:block">
                    <p class="text-sm font-semibold text-gray-800">Othinus</p>
                    <p class="text-xs text-gray-500">admin</p>
                </div>
                <div class="relative">
                    <button class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-semibold hover:bg-blue-200 transition-colors">
                        A
                    </button>
                </div>
                <button class="text-gray-400 hover:text-gray-600 transition-colors hidden sm:block">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</header>
