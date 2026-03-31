<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Portal Register | LaylaSchool</title>
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

        .register-selector {
            width: min(760px, 100%);
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

        .portal-grid {
            margin-top: 24px;
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
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

        .student .portal-icon { color: var(--cyan); }
        .teacher .portal-icon { color: var(--gold); }

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

        @media (max-width: 860px) {
            .portal-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="register-selector">
        <h1>Pilih Portal Register</h1>

        <div class="portal-grid">
            <a class="portal-card student" href="{{ route('register.role', 'siswa') }}">
                <div class="portal-icon"><i class="fa-solid fa-user-graduate"></i></div>
                <p class="portal-title">Portal Register Siswa</p>
            </a>

            <a class="portal-card teacher" href="{{ route('register.role', 'guru') }}">
                <div class="portal-icon"><i class="fa-solid fa-chalkboard-user"></i></div>
                <p class="portal-title">Portal Register Guru</p>
            </a>
        </div>

        <div class="auth-links">
            <span>Sudah punya akun? <a href="{{ route('login') }}">Masuk</a></span>
        </div>
    </div>
</body>
</html>
