<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="keyword" content="" />
    <meta name="author" content="flexilecode" />
    <title>{{ $title ?? 'Dashboard Siswa - LaylaSchool' }}</title>
    <!-- Force favicon reload -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}?v={{ time() }}">
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}?v={{ time() }}">
    <meta name="msapplication-TileImage" content="{{ asset('favicon.png') }}?v={{ time() }}">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/css/vendors.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/css/daterangepicker.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/theme.min.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
</head>

<body>
    @php
        // ✅ Ambil logo dari SiteSetting
        $logoPath = \App\Models\SiteSetting::getValue('school_logo');
        $logoUrl = $logoPath ? asset($logoPath) : asset('images/default-logo.png');
    @endphp

    {{-- Sidebar --}}
    <nav class="nxl-navigation">
        <div class="navbar-wrapper">
            <div class="m-header" style="display:none;">
                <a href="{{ route('student.dashboard') }}" class="b-brand">
                    <img src="{{ $logoUrl }}" alt="Logo" style="height: 50px; width:auto; object-fit:contain;" />
                </a>
            </div>
            <div class="navbar-content">
                <ul class="nxl-navbar">
                    <li class="nxl-item nxl-caption">
                        <label>Menu Utama</label>
                    </li>
                    <li class="nxl-item">
                        <a href="{{ route('student.dashboard') }}" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-home"></i></span>
                            <span class="nxl-mtext">Dashboard</span>
                        </a>
                    </li>
                    <li class="nxl-item">
                        <a href="{{ route('student.formulir') }}" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-file"></i></span>
                            <span class="nxl-mtext">Formulir Pendaftaran</span>
                        </a>
                    </li>
                    <li class="nxl-item">
                        <a href="{{ route('student.upload') }}" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-upload"></i></span>
                            <span class="nxl-mtext">Upload Berkas</span>
                        </a>
                    </li>
                    <li class="nxl-item">
    <a href="{{ route('student.materials') }}" class="nxl-link">
        <span class="nxl-micon"><i class="feather-book-open"></i></span>
        <span class="nxl-mtext">Materi</span>
    </a>
</li>
                    <li class="nxl-item">
                        <a href="{{ route('student.status') }}" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-clock"></i></span>
                            <span class="nxl-mtext">Status Pendaftaran</span>
                        </a>
                    </li>
                    <li class="nxl-item nxl-caption">
                        <label>Akun</label>
                    </li>
                    <li class="nxl-item">
                        <a href="{{ route('profile.edit') }}" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-user"></i></span>
                            <span class="nxl-mtext">Profil Saya</span>
                        </a>
                    </li>
                    <li class="nxl-item">
                        <form method="POST" action="{{ route('logout') }}" class="w-100">
                            @csrf
                            <button type="submit" class="nxl-link w-100 text-start" style="border: none; background: none;">
                                <span class="nxl-micon"><i class="feather-log-out"></i></span>
                                <span class="nxl-mtext">Logout</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="nxl-header">
        <div class="header-wrapper">
            <div class="header-left d-flex align-items-center gap-2">
                <a href="{{ route('student.dashboard') }}" class="d-flex align-items-center py-2">
                    <img src="{{ $logoUrl }}" alt="Logo" style="height:45px; width:auto; object-fit:contain;">
                </a>
                <a href="javascript:void(0);" class="nxl-head-mobile-toggler" id="mobile-collapse">
                    <div class="hamburger hamburger--arrowturn">
                        <div class="hamburger-box">
                            <div class="hamburger-inner"></div>
                        </div>
                    </div>
                </a>
                <div class="nxl-navigation-toggle">
                    <a href="javascript:void(0);" id="menu-mini-button">
                        <i class="feather-align-left"></i>
                    </a>
                    <a href="javascript:void(0);" id="menu-expend-button" style="display: none">
                        <i class="feather-arrow-right"></i>
                    </a>
                </div>
            </div>

            <div class="header-right ms-auto">
                <div class="d-flex align-items-center">
                    <div class="nxl-h-item">
                        <a href="javascript:void(0);" class="nxl-head-link me-3" id="theme-toggle" title="Toggle Dark/Light Mode">
                            <i class="feather-moon" id="theme-icon"></i>
                        </a>
                    </div>
                    
                    <div class="dropdown nxl-h-item">
                        <a href="javascript:void(0);" data-bs-toggle="dropdown" role="button" data-bs-auto-close="outside">
                            <span class="avatar-text rounded-circle bg-light text-primary d-inline-flex align-items-center justify-content-center" style="width:38px;height:38px;">
                                <i class="feather-user"></i>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end nxl-h-dropdown nxl-user-dropdown">
                            <div class="dropdown-header">
                                <div class="d-flex align-items-center">
                                    <span class="avatar-text rounded-circle bg-light text-primary d-inline-flex align-items-center justify-content-center me-2" style="width:38px;height:38px;">
                                        <i class="feather-user"></i>
                                    </span>
                                    <div>
                                        <h6 class="text-dark mb-0">{{ auth()->check() ? auth()->user()->name : 'User' }}</h6>
                                        <span class="fs-12 fw-medium text-muted">{{ auth()->check() ? auth()->user()->email : '' }}</span>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('student.dashboard') }}" class="dropdown-item">
                                <i class="feather-home"></i>
                                <span>Dashboard</span>
                            </a>
                            <a href="{{ route('student.materials') }}" class="dropdown-item">
                                 <i class="feather-book-open"></i>
                                 <span>Materi</span>
                                 </a>
                            <li class="nxl-item">
                                <a href="{{ route('student.schedule') }}" class="nxl-link">
                                    <span class="nxl-micon"><i class="feather-calendar"></i></span>
                                    <span class="nxl-mtext">Jadwal</span>
                                </a>
                            </li>
                            <a href="{{ route('profile.edit') }}" class="dropdown-item">
                                <i class="feather-settings"></i>
                                <span>Edit Profile</span>
                            </a>
                            <hr class="dropdown-divider">
                            <form method="POST" action="{{ route('logout') }}" class="w-100">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="feather-log-out"></i>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="nxl-container">
        <div class="nxl-content">
            @yield('content')
        </div>
        
        @include('layouts.partials.footer')
    </main>

    <!-- ========== Theme Assets JS ========== -->
    <script src="{{ asset('assets/vendors/js/vendors.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/js/daterangepicker.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/js/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/js/common-init.min.js') }}"></script>
    <script src="{{ asset('assets/js/theme-customizer-init.min.js') }}"></script>

    <!-- Dark/Light Mode Toggle Script -->
    <script>
        const themeToggle = document.getElementById('theme-toggle');
        const themeIcon = document.getElementById('theme-icon');
        const html = document.documentElement;

        // Check for saved theme preference or default to 'light'
        const currentTheme = localStorage.getItem('theme') || 'light';
        html.setAttribute('data-theme', currentTheme);
        updateThemeIcon(currentTheme);

        themeToggle.addEventListener('click', () => {
            const newTheme = html.getAttribute('data-theme') === 'light' ? 'dark' : 'light';
            html.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            updateThemeIcon(newTheme);
        });

        function updateThemeIcon(theme) {
            if (theme === 'dark') {
                themeIcon.classList.remove('feather-moon');
                themeIcon.classList.add('feather-sun');
            } else {
                themeIcon.classList.remove('feather-sun');
                themeIcon.classList.add('feather-moon');
            }
        }
    </script>
</body>

</html>