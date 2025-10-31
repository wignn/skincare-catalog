<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

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

        .register-box {
            background-color: #111;
            color: #fff;
            padding: 2.5rem;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.25);
            width: 380px;
        }

        .register-box h2 {
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

        .btn-register {
            background-color: #f9f6f1;
            color: #111;
            font-weight: 600;
            border: none;
            width: 100%;
            border-radius: 8px;
            padding: 0.75rem;
            transition: 0.3s;
        }

        .btn-register:hover {
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
    <div class="register-box">
        <h2>register</h2>
        <div class="separator"></div>

        @if(session('failed'))
            <div class="alert alert-danger">
                {{ session('failed') }}
            </div>
        @endif

        <form method="POST" action="/register">
            @csrf
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input id="name" type="text" name="name" class="form-control" placeholder="Masukkan nama" value="{{ old('name') }}" required autofocus>
            </div>

            @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input id="email" type="email" name="email" class="form-control" placeholder="Masukkan email" value="{{ old('email') }}" required autofocus>
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

            @error('confirm_password')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror


            <div class="mb-3">
                <label for="password" class="form-label">Konfirmasi Kata Sandi</label>
                <div class="input-group">
                    <input id="confirm_password" type="password" name="confirm_password" class="form-control" placeholder="Konfirmasi kata sandi" required>
                    <span class="input-group-text" id="toggleConfirmPassword">
                        <i class="fa-solid fa-eye"></i>
                    </span>
                </div>
            </div>

            <button type="submit" class="btn btn-register">Daftar</button>

        </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

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
