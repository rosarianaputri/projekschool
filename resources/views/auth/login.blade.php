<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Akun | LaylaSchool</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --navy: #0e355f;
            --cyan: #48d7d1;
            --gold: #f6b73c;
            --bg-soft: rgba(255, 255, 255, 0.92);
        }

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            min-height: 100vh;
            background:
                linear-gradient(130deg, rgba(14, 53, 95, 0.8), rgba(12, 96, 127, 0.7)),
                url('{{ asset('images/home-hero.jpg') }}') center center / cover no-repeat;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 24px;
        }

        .login-selector {
            width: min(920px, 100%);
            background: var(--bg-soft);
            border-radius: 18px;
            box-shadow: 0 16px 42px rgba(0, 0, 0, 0.24);
            padding: 34px 30px;
            text-align: center;
        }

        h1 {
            margin: 0;
            color: #142337;
            font-size: 2rem;
            font-weight: 800;
        }

        .subtitle {
            margin: 10px 0 28px;
            color: #36557a;
            font-size: 0.98rem;
        }

        .portal-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 16px;
        }

        .alert {
            margin: 14px auto 18px;
            max-width: 620px;
            border: 1px solid #f3c6b0;
            background: #fff0e8;
            color: #8f3d1e;
            border-radius: 10px;
            padding: 10px 14px;
            font-size: 0.92rem;
            font-weight: 600;
        }

        .portal-card {
            text-decoration: none;
            color: #0f2a43;
            background: #ffffff;
            border-radius: 14px;
            padding: 24px 16px;
            border: 1px solid #d8e3f0;
            transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
        }

        .portal-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 24px rgba(19, 70, 120, 0.18);
            border-color: #8fb8df;
        }

        .portal-icon {
            font-size: 1.9rem;
            margin-bottom: 12px;
        }

        .portal-title {
            margin: 0;
            font-size: 1.15rem;
            font-weight: 700;
        }

        .auth-links {
            margin-top: 20px;
            font-size: 0.95rem;
            color: #305277;
        }

        .auth-links a {
            color: var(--navy);
            text-decoration: none;
            font-weight: 600;
        }

        .auth-links a:hover {
            text-decoration: underline;
        }

        .admin .portal-icon { color: var(--navy); }
        .student .portal-icon { color: var(--cyan); }
        .teacher .portal-icon { color: var(--gold); }

        @media (max-width: 860px) {
            .portal-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="login-selector">
        <h1>Masuk Akun</h1>

        @if (session('error'))
            <div class="alert">{{ session('error') }}</div>
        @endif

        <div class="portal-grid">
            <a class="portal-card student" href="{{ route('login.role', 'siswa') }}">
                <div class="portal-icon"><i class="fa-solid fa-user-graduate"></i></div>
                <p class="portal-title">Masuk Sebagai Siswa</p>
            </a>
        </div>

        <div class="auth-links">
            <span>Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a></span>
        </div>
    </div>
</body>
</html>
