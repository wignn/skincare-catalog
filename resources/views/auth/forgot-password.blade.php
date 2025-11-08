<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white shadow-lg rounded-2xl p-8 w-96">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Lupa Password</h2>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded-lg mb-4 text-sm">
                {{ session('success') }}
            </div>
        @endif

        @if(session('failed'))
            <div class="bg-red-100 text-red-700 p-3 rounded-lg mb-4 text-sm">
                {{ session('failed') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
            @csrf

            @error('email')
                <div class="bg-red-100 text-red-700 p-2 rounded text-sm">{{ $message }}</div>
            @enderror

            <div>
                <label for="email" class="block text-gray-700 font-medium mb-1">Email</label>
                <input id="email" type="email" name="email" placeholder="Masukkan email"
                value="{{ old('email') }}"
                class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none" required>
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg transition-all">
                Kirim Link Reset Password
            </button>

            <div class="text-center mt-3">
                <a href="{{ route('login') }}" class="text-blue-600 hover:underline text-sm">Kembali ke Login</a>
            </div>
        </form>
    </div>

</body>
</html>
