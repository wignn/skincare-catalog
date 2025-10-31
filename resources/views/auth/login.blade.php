<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loginl</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://kit.fontawesome.com/28c480c2cf.js" crossorigin="anonymous"></script>

    <style>
        body {
            background-color: #f9f6f1;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            font-family: 'Poppins', sans-serif;
        }

        .login-box {
            background-color: #111;
            color: #fff;
            padding: 2.5rem;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.25);
            width: 380px;
        }

        .login-box h2 {
            text-align: center;
            margin-bottom: 1rem;
        }

        .separator {
            height: 1px;
            background-color: #fff;
            opacity: 0.5;
            margin: 1rem 0 2rem;
        }

        .form-control {
            background-color: #e8f0ff;
            border: none;
            border-radius: 8px;
        }

        .form-control:focus {
            background-color: #dbe5ff;
            box-shadow: none;
        }

        .btn-login {
            background-color: #f9f6f1;
            color: #111;
            font-weight: 600;
            border: none;
            width: 100%;
            border-radius: 8px;
            padding: 0.75rem;
            transition: 0.3s;
        }

        .btn-login:hover {
            background-color: #e8e4da;
        }

        .footer {
            text-align: center;
            margin-top: 1rem;
            font-size: 0.9rem;
            color: #aaa;
        }

        .footer a {
            color: #f9f6f1;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        .input-group-text {
            background-color: #e8f0ff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        .input-group-text:hover {
            background-color: #dbe5ff;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Login</h2>
        <div class="separator"></div>

        @if(session('failed'))
            <div class="alert alert-danger">
                {{ session('failed') }}
            </div>
        @endif

        <form method="POST" action="/login">
            @csrf
            @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input id="email" type="email" name="email" class="form-control" placeholder="Masukkan email" required autofocus>
            </div>

            @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror


            <div class="mb-3">
                <label for="password" class="form-label">Kata Sandi</label>
                <div class="input-group">
                    <input id="password" type="password" name="password" class="form-control" placeholder="Masukkan kata sandi" required>
                    <span class="input-group-text" id="togglePassword">
                        <i class="fa-solid fa-eye"></i>
                    </span>
                </div>
            </div>

            <div class="form-check text-start mb-3">
                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                <label class="form-check-label" for="remember">
                    Ingat saya
                 </label>
            </div>

            <button type="submit" class="btn btn-login">Masuk</button>

            <div class="footer">
                Belum punya akun? <a href="/register">Daftar</a>
            </div>

            <div class="mt-3">
                <a href="/auth/google/redirect" class="btn btn-outline-light w-100 d-flex align-items-center justify-content-center gap-2" style="background-color: #fff; color: #000; border-radius: 10px;">
                    <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google" width="20">
                    <span>Masuk dengan Google</span>
                </a>
            </div>

        </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

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
