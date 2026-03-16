<style>
    .navbar{
        height:70px;
        padding-top:0;
        padding-bottom:0;
        background:white !important;
    }

    .logo-navbar{
        height:110px; 
        width:auto;
        object-fit:contain;
    }

    .navbar-brand{
        display:flex;
        align-items:center;
        height:70px;
        overflow:hidden;
    }

    .navbar-nav .nav-link{
        font-weight:500;
        padding-left:15px;
        padding-right:15px;
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

        </ul>
    </div>

</div>


</nav>
