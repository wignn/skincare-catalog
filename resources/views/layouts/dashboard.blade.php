<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mirglow Dashboard</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-white text-gray-900">

    <nav class="flex justify-between items-center p-6 border-b">
        <div class="font-bold text-xl tracking-wide">Mirglow</div>
        <ul class="flex space-x-6">
            <li><a href="{{ route('dashboard.index') }}" class="hover:text-gray-600">Home</a></li>
            <li><a href="#" class="hover:text-gray-600">Products</a></li>
            <li><a href="#" class="hover:text-gray-600">About</a></li>
        </ul>
        <div>
            <a href="/logout" class="border px-4 py-2 hover:bg-gray-100">Logout</a>
        </div>
    </nav>
    @if (session('success'))
        <div class="max-w-2xl mt-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
            role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
    <div class="p-10">
        @yield('content')
    </div>
    
    {{-- <a href="{{ route('products.create') }}"
        class="fixed bottom-6 right-6 bg-black hover:bg-gray-500 text-white rounded-full p-4 shadow-lg transition ">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
    </a> --}}


</body>

</html>
