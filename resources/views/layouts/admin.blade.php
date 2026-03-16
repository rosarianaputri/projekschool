<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="keyword" content="" />
    <meta name="author" content="flexilecode" />
    <title>{{ $title ?? 'LaylaSchool' }}</title>
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
    @include('layouts.partials.sidebar', ['logoUrl' => $logoUrl])

    <header class="nxl-header">
        <div class="header-wrapper">
            <div class="header-left d-flex align-items-center gap-4">
                <a href="{{ route('dashboard') }}" class="d-flex align-items-center">
                    <img src="{{ $logoUrl }}" alt="Logo" style="height:90px; width:auto; object-fit:contain;">
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
                            <a href="{{ route('dashboard') }}" class="dropdown-item">
                                <i class="feather-home"></i>
                                <span>Dashboard</span>
                            </a>
                            <a href="{{ route('front.home') }}" class="dropdown-item" target="_blank">
                                <i class="feather-globe"></i>
                                <span>View Website</span>
                            </a>
                            <a href="{{ route('front.about') }}" class="dropdown-item" target="_blank">
                                <i class="feather-info"></i>
                                <span>About</span>
                            </a>
                            <a href="{{ route('front.academic') }}" class="dropdown-item" target="_blank">
                                <i class="feather-book"></i>
                                <span>Academic</span>
                            </a>
                            <a href="{{ route('front.facilities') }}" class="dropdown-item" target="_blank">
                                <i class="feather-grid"></i>
                                <span>Facilities</span>
                            </a>
                            <a href="{{ route('front.student_life') }}" class="dropdown-item" target="_blank">
                                <i class="feather-users"></i>
                                <span>Student Life</span>
                            </a>
                            <a href="{{ route('front.information') }}" class="dropdown-item" target="_blank">
                                <i class="feather-file-text"></i>
                                <span>Information</span>
                            </a>
                            <a href="{{ route('front.contact') }}" class="dropdown-item" target="_blank">
                                <i class="feather-mail"></i>
                                <span>Contact</span>
                            </a>
                            <a href="{{ route('profile.edit') }}" class="dropdown-item">
                                <i class="feather-user"></i>
                                <span>Profile</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">
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
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center">
                    <div class="page-header-title">
                        <h5 class="m-b-10">{{ $pageTitle ?? '' }}</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        @isset($pageTitle)
                            <li class="breadcrumb-item">{{ $pageTitle }}</li>
                        @endisset
                    </ul>
                </div>
            </div>

            <div class="main-content">
                @yield('content')
            </div>
        </div>

        @include('layouts.partials.footer')
    </main>

    <script src="{{ asset('assets/vendors/js/vendors.min.js') }}"></script>
    <script src="{{ asset('assets/js/common-init.min.js') }}"></script>
    <script src="{{ asset('assets/js/theme-customizer-init.min.js') }}"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const themeToggle = document.getElementById('theme-toggle');
            const themeIcon = document.getElementById('theme-icon');
            const body = document.body;
            const currentTheme = localStorage.getItem('theme') || 'light';
            
            if (currentTheme === 'dark') {
                body.classList.add('dark-theme');
                themeIcon.classList.replace('feather-moon', 'feather-sun');
            }
            
            themeToggle.addEventListener('click', function() {
                if (body.classList.contains('dark-theme')) {
                    body.classList.remove('dark-theme');
                    themeIcon.classList.replace('feather-sun', 'feather-moon');
                    localStorage.setItem('theme', 'light');
                } else {
                    body.classList.add('dark-theme');
                    themeIcon.classList.replace('feather-moon', 'feather-sun');
                    localStorage.setItem('theme', 'dark');
                }
            });
        });
    </script>

    <style>
        .dark-theme {
            background-color: #1a1a1a !important;
            color: #ffffff !important;
        }
        .dark-theme .nxl-header { background-color: #2d2d2d !important; border-bottom-color: #404040 !important; }
        .dark-theme .nxl-navigation { background-color: #2d2d2d !important; }
        .dark-theme .nxl-navigation .nxl-link { color: #ffffff !important; }
        .dark-theme .nxl-navigation .nxl-link:hover { background-color: #404040 !important; color: #ffffff !important; }
        .dark-theme .card { background-color: #2d2d2d !important; border-color: #404040 !important; }
        .dark-theme .form-control { background-color: #404040 !important; border-color: #555555 !important; color: #ffffff !important; }
        #theme-toggle { transition: all 0.3s ease; }
        #theme-toggle:hover { color: #007bff !important; transform: rotate(15deg); }
    </style>
    
    @stack('scripts')

</body>
</html>
