<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://kit.fontawesome.com/28c480c2cf.js" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white shadow-lg rounded-2xl p-8 w-96">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Register</h2>

        @if(session('failed'))
            <div class="bg-red-100 text-red-700 p-3 rounded-lg mb-4 text-sm">
                {{ session('failed') }}
            </div>
        @endif

        <form method="POST" action="/register" class="space-y-4">
            @csrf

            @error('name')
                <div class="bg-red-100 text-red-700 p-2 rounded text-sm">{{ $message }}</div>
            @enderror
            <div>
                <label for="name" class="block text-gray-700 font-medium mb-1">Nama</label>
                <input id="name" type="text" name="name" placeholder="Masukkan nama" value="{{ old('name') }}"
                class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none" required autofocus>
            </div>

            @error('email')
                <div class="bg-red-100 text-red-700 p-2 rounded text-sm">{{ $message }}</div>
            @enderror
            <div>
                <label for="email" class="block text-gray-700 font-medium mb-1">Email</label>
                <input id="email" type="email" name="email" placeholder="Masukkan email" value="{{ old('email') }}"
                class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none" required>
            </div>

            @error('password')
                <div class="bg-red-100 text-red-700 p-2 rounded text-sm">{{ $message }}</div>
            @enderror
            <div>
                <label for="password" class="block text-gray-700 font-medium mb-1">Kata Sandi</label>
                <div class="relative">
                    <input id="password" type="password" name="password" placeholder="Masukkan kata sandi"
                    class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none pr-10"  required>

                    <span id="togglePassword" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 cursor-pointer">
                        <i class="fa-solid fa-eye"></i>
                    </span>
                </div>
            </div>

            @error('confirm_password')
                <div class="bg-red-100 text-red-700 p-2 rounded text-sm">{{ $message }}</div>
            @enderror
            <div>
                <label for="confirm_password" class="block text-gray-700 font-medium mb-1">Konfirmasi Kata Sandi</label>
                <div class="relative">
                    <input id="confirm_password" type="password" name="confirm_password" placeholder="Konfirmasi kata sandi"
                    class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none pr-10"  required>
                    <span id="toggleConfirmPassword" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 cursor-pointer">
                        <i class="fa-solid fa-eye"></i>
                    </span>
                </div>
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg transition-all">
                Daftar
            </button>
        </form>
    </div>

    <script>
        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('confirm_password');
        const togglePassword = document.getElementById('togglePassword');
        const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');

        togglePassword.addEventListener('click', function () {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.querySelector('i').classList.toggle('fa-eye');
            this.querySelector('i').classList.toggle('fa-eye-slash');
        });

        toggleConfirmPassword.addEventListener('click', function () {
            const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
            confirmPassword.setAttribute('type', type);
            this.querySelector('i').classList.toggle('fa-eye');
            this.querySelector('i').classList.toggle('fa-eye-slash');
        });
    </script>

</body>
</html>
