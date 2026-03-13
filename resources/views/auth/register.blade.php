<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | LaylaSchool</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            background: url('{{ asset('images/home-hero.jpg') }}') center center / cover no-repeat;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .register-box {
            background-color: rgba(255, 255, 255, 0.9);
            width: 420px;
            padding: 40px 45px;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .register-box h1 {
            font-size: 28px;
            font-weight: 800;
            color: #222;
            margin-bottom: 25px;
        }

        .form-group {
            text-align: left;
            margin-bottom: 18px;
        }

        .form-group label {
            display: flex;
            align-items: center;
            font-weight: 600;
            color: #333;
            font-size: 14px;
            margin-bottom: 6px;
            text-transform: lowercase;
        }

        .form-group label i {
            margin-right: 6px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px 14px;
            border: none;
            border-radius: 6px;
            background-color: #b7cce3;
            font-size: 15px;
            outline: none;
        }

        button {
            width: 100%;
            background-color: #2e5fa9;
            color: white;
            border: none;
            border-radius: 6px;
            padding: 12px;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 10px;
        }

        button:hover {
            background-color: #244c87;
        }

        .links {
            margin-top: 18px;
            font-size: 14px;
        }

        .links a {
            color: #2e5fa9;
            text-decoration: none;
        }

        .links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="register-box">
        <h1>REGISTER</h1>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <label for="name"><i class="fa fa-user"></i> Nama Lengkap</label>
                <input id="name" type="text" name="name" placeholder="Masukkan Nama Lengkap" value="{{ old('name') }}" required autofocus>
            </div>

            <div class="form-group">
                <label for="email"><i class="fa fa-envelope"></i> Email</label>
                <input id="email" type="email" name="email" placeholder="Masukkan Email" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <label for="password"><i class="fa fa-lock"></i> Password</label>
                <input id="password" type="password" name="password" placeholder="Password" required>
            </div>

            <div class="form-group">
                <label for="password_confirmation"><i class="fa fa-lock"></i> Konfirmasi Password  </label>
                <input id="password_confirmation" type="password" name="password_confirmation" placeholder="Ulangi Password" required>
            </div>

            <button type="submit">Daftar</button>

            <div class="links">
                <span>Sudah punya akun? <a href="{{ route('login') }}">Masuk</a></span>
            </div>
        </form>
    </div>
</body>
</html>
