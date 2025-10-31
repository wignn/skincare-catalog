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
            <a href="#" class="border px-4 py-2 hover:bg-gray-100">Logout</a>
        </div>  
    </nav>


    <div class="p-10">
        @yield('content')
    </div>
</body>
</html>
