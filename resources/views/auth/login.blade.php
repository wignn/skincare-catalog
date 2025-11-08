<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Mirglow</title>
  <script src="https://kit.fontawesome.com/28c480c2cf.js" crossorigin="anonymous"></script>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen ">

  <div class="bg-white shadow-lg rounded-2xl w-full max-w-sm p-8">
    <h2 class="text-2xl font-semibold text-center text-gray-800 mb-1">Masuk ke Mirglow</h2>
    <p class="text-sm text-gray-500 text-center mb-6">Gunakan akun Anda untuk melanjutkan</p>

    @if(session('failed'))
      <div class="bg-red-100 text-red-700 text-sm p-2 rounded mb-3">{{ session('failed') }}</div>
    @endif

    <form method="POST" action="/login">
      @csrf

      <div class="mb-4">
        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
        <input id="email" type="email" name="email" placeholder="Masukkan email" value="{{ old('email') }}"
          class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
        @error('email')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div class="mb-4">
        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
        <div class="relative">
          <input id="password" type="password" name="password" placeholder="Masukkan Password"
            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none pr-10">
          <span id="togglePassword" class="absolute inset-y-0 right-3 flex items-center cursor-pointer text-gray-500">
            <i class="fa-solid fa-eye"></i>
          </span>
        </div>
        @error('password')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div class="flex items-center justify-between mb-4">
        <label class="flex items-center gap-2 text-sm text-gray-700">
          <input type="checkbox" name="remember" class="rounded border-gray-300">
          Ingat saya
        </label>
        <a href="/forgot-password" class="text-sm text-blue-600 hover:underline">Lupa Password?</a>
      </div>

      <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg transition">
        Masuk
      </button>

      <div class="text-center text-sm mt-4 text-gray-600">
        Belum punya akun?
        <a href="/register" class="text-blue-600 hover:underline font-medium">Daftar</a>
      </div>

      <div class="mt-4">
        <a href="/auth-google-redirect"
           class="w-full flex items-center justify-center gap-2 border border-gray-300 rounded-lg py-2 text-gray-700 hover:bg-gray-100 transition">
          <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google" width="18">
          <span>Masuk dengan Google</span>
        </a>
      </div>
    </form>
  </div>

  <script>
    const togglePassword = document.getElementById('togglePassword');
    const password = document.getElementById('password');
    togglePassword.addEventListener('click', function () {
      const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
      password.setAttribute('type', type);
      this.querySelector('i').classList.toggle('fa-eye');
      this.querySelector('i').classList.toggle('fa-eye-slash');
    });
  </script>

</body>
</html>
