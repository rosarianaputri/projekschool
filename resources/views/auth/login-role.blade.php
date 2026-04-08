<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login {{ $roleLabel }} | LaylaSchool</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --ink: #10263d;
            --panel: rgba(255, 255, 255, 0.92);
            --line: #d9e4f2;
            --admin: #164a7a;
            --teacher: #b97b12;
            --student: #0f8b7d;
        }

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            background:
                linear-gradient(140deg, rgba(9, 34, 61, 0.82), rgba(12, 87, 115, 0.72)),
                url('{{ asset('images/home-hero.jpg') }}') center center / cover no-repeat;
        }

        .login-box {
            width: min(430px, 100%);
            background: var(--panel);
            border-radius: 16px;
            box-shadow: 0 18px 44px rgba(0, 0, 0, 0.25);
            padding: 34px 28px;
        }

        .role-chip {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 12px;
            border-radius: 999px;
            font-size: 0.86rem;
            font-weight: 700;
            letter-spacing: 0.01em;
            margin-bottom: 16px;
            background: #edf4fd;
            color: var(--ink);
        }

        .role-admin .role-chip { background: #e5effb; color: var(--admin); }
        .role-teacher .role-chip { background: #fff3df; color: var(--teacher); }
        .role-student .role-chip { background: #e4f8f4; color: var(--student); }

        h1 {
            margin: 0 0 6px;
            color: #182a41;
            font-size: 1.72rem;
        }

        .subtitle {
            margin: 0 0 22px;
            color: #4e6686;
            font-size: 0.96rem;
        }

        .error-box {
            margin-bottom: 14px;
            border: 1px solid #f1b8b8;
            background: #fff1f1;
            color: #9b2b2b;
            border-radius: 10px;
            padding: 10px 12px;
            font-size: 0.9rem;
        }

        .form-group {
            margin-bottom: 14px;
        }

        .form-group label {
            display: block;
            margin-bottom: 6px;
            font-size: 0.9rem;
            color: #2d4769;
            font-weight: 600;
        }

        .form-group input {
            width: 100%;
            border: 1px solid var(--line);
            border-radius: 10px;
            padding: 11px 13px;
            font-size: 0.96rem;
            box-sizing: border-box;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 2px;
            margin-bottom: 16px;
            color: #415b7a;
            font-size: 0.9rem;
        }

        .remember input {
            width: auto;
            margin: 0;
        }

        .login-btn {
            width: 100%;
            border: none;
            border-radius: 10px;
            color: #fff;
            font-size: 0.98rem;
            font-weight: 700;
            padding: 12px;
            cursor: pointer;
            transition: transform 0.2s ease, opacity 0.2s ease;
        }

        .login-btn:hover {
            transform: translateY(-1px);
            opacity: 0.92;
        }

        .role-admin .login-btn { background: var(--admin); }
        .role-teacher .login-btn { background: var(--teacher); }
        .role-student .login-btn { background: var(--student); }

        .links {
            margin-top: 16px;
            font-size: 0.9rem;
            display: flex;
            justify-content: flex-end;
            gap: 12px;
        }

        .links a {
            text-decoration: none;
            color: #26496f;
            font-weight: 600;
        }

        .links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-box role-{{ $role }}">
        <div class="role-chip">
            <i class="fa-solid fa-id-badge"></i>
            Akun {{ $roleLabel }}
        </div>

        <h1>Masuk {{ $roleLabel }}</h1>

        @if (session('error'))
            <div class="error-box">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="error-box">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.role.store', $role) }}">
            @csrf

            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email" required autofocus>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" placeholder="Masukkan password" required>
            </div>

            <label class="remember" for="remember">
                <input id="remember" type="checkbox" name="remember" value="1" {{ old('remember') ? 'checked' : '' }}>
                Ingat saya
            </label>

            <button class="login-btn" type="submit">Masuk {{ $roleLabel }}</button>

            <div class="links">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">Lupa password?</a>
                @endif
            </div>
        </form>
    </div>
</body>
</html>
