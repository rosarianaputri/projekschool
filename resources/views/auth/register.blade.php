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
            --cyan: #27c2b8;
            --gold: #e4a93a;
            --text-main: #142337;
            --text-muted: #5a7088;
            --line: #d8e3f0;
            --panel: rgba(255, 255, 255, 0.95);
            --danger-bg: #fff1f1;
            --danger-border: #f2c3c3;
            --danger-text: #a02828;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            min-height: 100vh;
            background:
                linear-gradient(135deg, rgba(14, 53, 95, 0.84), rgba(12, 96, 127, 0.72)),
                url('{{ asset('images/home-hero.jpg') }}') center center / cover no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        .login-shell {
            width: 100%;
            max-width: 1080px;
            display: grid;
            grid-template-columns: 1.08fr 0.92fr;
            background: var(--panel);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 18px 50px rgba(0, 0, 0, 0.24);
        }

        .login-left {
            padding: 48px 40px;
            background: linear-gradient(145deg, rgba(14, 53, 95, 0.97), rgba(22, 86, 118, 0.94));
            color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .brand-badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.18);
            padding: 10px 16px;
            border-radius: 999px;
            font-weight: 700;
            margin-bottom: 24px;
            width: fit-content;
        }

        .login-left h1 {
            margin: 0 0 14px;
            font-size: 2.15rem;
            line-height: 1.2;
        }

        .login-left p {
            margin: 0 0 16px;
            color: rgba(255,255,255,0.86);
            line-height: 1.8;
            max-width: 540px;
        }

        .school-note {
            margin-top: 10px;
            padding: 18px 20px;
            border-radius: 16px;
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.08);
            color: rgba(255,255,255,0.88);
            line-height: 1.7;
            max-width: 520px;
        }

        .login-right {
            padding: 42px 34px;
            background: rgba(255,255,255,0.98);
        }

        .login-header h2 {
            margin: 0;
            color: var(--text-main);
            font-size: 1.9rem;
        }

        .login-header p {
            margin: 10px 0 0;
            color: var(--text-muted);
            line-height: 1.6;
        }

        .error-box {
            margin-top: 18px;
            border-radius: 12px;
            padding: 12px 14px;
            font-size: 0.95rem;
            font-weight: 600;
            background: var(--danger-bg);
            border: 1px solid var(--danger-border);
            color: var(--danger-text);
        }

        .form-wrap {
            margin-top: 24px;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-group label {
            display: block;
            margin-bottom: 7px;
            font-size: 0.92rem;
            color: #2d4769;
            font-weight: 700;
        }

        .form-group input {
            width: 100%;
            border: 1px solid var(--line);
            border-radius: 12px;
            padding: 13px 14px;
            font-size: 0.96rem;
            outline: none;
            background: #fff;
        }

        .form-group input:focus {
            border-color: #8ab0d8;
            box-shadow: 0 0 0 3px rgba(88, 131, 181, 0.12);
        }

        .password-wrap {
            position: relative;
        }

        .password-wrap input {
            padding-right: 48px;
        }

        .toggle-password {
            position: absolute;
            top: 50%;
            right: 12px;
            transform: translateY(-50%);
            border: none;
            background: transparent;
            color: #6b7f95;
            cursor: pointer;
            font-size: 1rem;
            padding: 4px;
        }

        .toggle-password:hover {
            color: #0e355f;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 2px;
            margin-bottom: 18px;
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
            border-radius: 12px;
            background: var(--navy);
            color: #fff;
            font-size: 0.98rem;
            font-weight: 700;
            padding: 13px;
            cursor: pointer;
            transition: transform 0.2s ease, opacity 0.2s ease;
        }

        .login-btn:hover {
            transform: translateY(-1px);
            opacity: 0.95;
        }

        .helper-box {
            margin-top: 22px;
            background: #f8fbff;
            border: 1px solid #e2edf8;
            border-radius: 14px;
            padding: 16px;
        }

        .helper-box h4 {
            margin: 0 0 8px;
            color: var(--text-main);
            font-size: 1rem;
        }

        .helper-box p {
            margin: 0;
            color: var(--text-muted);
            font-size: 0.92rem;
            line-height: 1.6;
        }

        .links {
            margin-top: 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .links a {
            text-decoration: none;
            color: #26496f;
            font-weight: 700;
            font-size: 0.9rem;
        }

        .links a:hover {
            text-decoration: underline;
        }

        @media (max-width: 920px) {
            .login-shell {
                grid-template-columns: 1fr;
            }

            .login-left,
            .login-right {
                padding: 30px 22px;
            }

            .login-left h1 {
                font-size: 1.8rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-shell">
        <div class="login-left">
            <div class="brand-badge">
                <i class="fa-solid fa-school"></i>
                <span>LaylaSchool Portal</span>
            </div>

            <h1>Selamat datang di LaylaSchool</h1>

            <p>
                LaylaSchool merupakan sistem informasi sekolah yang dirancang untuk membantu proses
                pembelajaran dan pengelolaan data akademik dalam satu platform yang terintegrasi.
            </p>

            <p>
                Melalui sistem ini, pengguna dapat mengakses informasi sekolah, kegiatan belajar,
                serta kebutuhan administrasi dengan lebih mudah, tertata, dan efisien.
            </p>

            <div class="school-note">
                Portal ini digunakan sebagai media utama untuk mendukung aktivitas sekolah secara digital,
                mulai dari pengelolaan data hingga akses informasi pembelajaran.
            </div>
        </div>

        <div class="login-right">
            <div class="login-header">
                <h2>Masuk ke Akun</h2>
                <p>Gunakan email dan password yang sudah terdaftar di sistem.</p>
            </div>

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

            <div class="form-wrap">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="Masukkan email"
                            required
                            autofocus
                        >
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="password-wrap">
                            <input
                                id="password"
                                type="password"
                                name="password"
                                placeholder="Masukkan password"
                                required
                            >
                            <button type="button" class="toggle-password" data-target="password">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <label class="remember" for="remember">
                        <input id="remember" type="checkbox" name="remember" value="1" {{ old('remember') ? 'checked' : '' }}>
                        Ingat saya
                    </label>

                    <button class="login-btn" type="submit">
                        Masuk
                    </button>

                    <div class="links">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">Lupa password?</a>
                        @endif

                        <a href="{{ route('register') }}">Daftar akun siswa</a>
                    </div>
                </form>
            </div>

            <div class="helper-box">
                <h4>Informasi</h4>
                <p>
                    Siswa dapat membuat akun melalui halaman pendaftaran. Akun guru dan admin
                    dikelola langsung oleh pihak sekolah.
                </p>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.toggle-password').forEach(button => {
            button.addEventListener('click', function () {
                const targetId = this.getAttribute('data-target');
                const input = document.getElementById(targetId);
                const icon = this.querySelector('i');

                if (!input) return;

                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        });
    </script>
</body>
</html>