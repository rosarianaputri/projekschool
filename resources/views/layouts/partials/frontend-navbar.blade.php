<style>
    .navbar {
        min-height: 78px;
        padding: 0;
        background: #ffffff !important;
        border-bottom: 1px solid rgba(0, 0, 0, 0.08);
        box-shadow: 0 10px 24px rgba(14, 26, 40, 0.06);
    }

    .logo-navbar {
        height: 56px;
        width: auto;
        object-fit: contain;
    }

    .navbar-brand {
        display: flex;
        align-items: center;
        height: 78px;
        overflow: hidden;
    }

    .navbar-nav {
        gap: 2px;
    }

    .navbar-nav .nav-link {
        color: #1f2937;
        font-weight: 600;
        padding: 9px 12px;
        border-radius: 10px;
        transition: background-color 0.2s ease, color 0.2s ease;
    }

    .navbar-nav .nav-link:hover,
    .navbar-nav .nav-link.active {
        color: #0f172a;
        background: #eef3fb;
    }

    .nav-login-btn {
        margin-left: 10px;
        padding: 10px 18px;
        border-radius: 12px;
        font-weight: 600;
        line-height: 1;
        letter-spacing: 0.01em;
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        border: none;
        box-shadow: 0 10px 20px rgba(37, 99, 235, 0.25);
        transition: transform 0.15s ease, box-shadow 0.2s ease;
    }

    .nav-login-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 14px 24px rgba(37, 99, 235, 0.3);
    }

    @media (max-width: 991.98px) {
        .navbar {
            padding: 8px 0;
        }

        .navbar-brand {
            height: 62px;
        }

        .logo-navbar {
            height: 48px;
        }

        .navbar-nav {
            padding-top: 10px;
            gap: 6px;
        }

        .nav-login-btn {
            margin-left: 0;
            margin-top: 10px;
            display: inline-block;
        }
    }
</style>

<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">

    @php
        $logoPath = \App\Models\SiteSetting::getValue('school_logo');
        $logoUrl = $logoPath ? asset($logoPath) : asset('images/default-logo.png');
    @endphp

    <a class="navbar-brand" href="{{ route('front.home') }}">
        <img src="{{ $logoUrl }}" alt="Layla School" class="logo-navbar">
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto align-items-center">

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('front.home') ? 'active' : '' }}" href="{{ route('front.home') }}">Home</a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('front.about') ? 'active' : '' }}" href="{{ route('front.about') }}">About Us</a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('front.academic') ? 'active' : '' }}" href="{{ route('front.academic') }}">Academic</a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('front.facilities') ? 'active' : '' }}" href="{{ route('front.facilities') }}">Facilities</a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('front.student_life') ? 'active' : '' }}" href="{{ route('front.student_life') }}">Student Life</a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('front.information') ? 'active' : '' }}" href="{{ route('front.information') }}">Information</a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('front.ppdb') || request()->routeIs('front.ppdb.form') ? 'active' : '' }}" href="{{ route('front.ppdb') }}">PPDB</a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('front.contact') ? 'active' : '' }}" href="{{ route('front.contact') }}">Contact Us</a>
            </li>

            @guest
                <li class="nav-item">
                    <a class="btn btn-primary nav-login-btn" href="{{ route('login') }}">Login</a>
                </li>
            @endguest

            @auth
                <li class="nav-item">
                    <a class="btn btn-primary nav-login-btn" href="{{ url(auth()->user()->dashboardPath()) }}">Dashboard</a>
                </li>
            @endauth

        </ul>
    </div>

</div>


</nav>
