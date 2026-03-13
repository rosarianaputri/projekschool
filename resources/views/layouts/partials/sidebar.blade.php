<nav class="nxl-navigation">
    @php
        // Ambil logo dari pengaturan
        $logoPath = \App\Models\SiteSetting::getValue('school_logo');
        $logoUrl = $logoPath ? asset($logoPath) : asset('images/default-logo.png');
    @endphp

    <div class="navbar-wrapper">
        <div class="m-header" style="display: flex; align-items: center; justify-content: center; height: 70px;">
            <a href="{{ route('dashboard') }}" class="b-brand" style="display: flex; align-items: center; justify-content: center; padding: 8px 12px;">
                <img src="{{ $logoUrl }}" alt="Logo" class="logo logo-lg" style="max-height: 50px; width: auto; object-fit: contain;" />
            </a>
        </div>

        <div class="navbar-content">
            <ul class="nxl-navbar">
                <li class="nxl-item nxl-caption">
                    <label>Navigation</label>
                </li>
                <li class="nxl-item nxl-hasmenu">
                    <a href="{{ route('dashboard') }}" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-home"></i></span>
                        <span class="nxl-mtext">Dashboards</span>
                    </a>
                </li>
                <li class="nxl-item nxl-hasmenu">
                    <a href="{{ route('admin.home') }}" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-globe"></i></span>
                        <span class="nxl-mtext">Home</span>
                    </a>
                </li>
                <li class="nxl-item nxl-hasmenu">
                    <a href="{{ route('admin.about') }}" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-info"></i></span>
                        <span class="nxl-mtext">About</span>
                    </a>
                </li>
                <li class="nxl-item nxl-hasmenu">
                    <a href="{{ route('admin.academic') }}" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-book"></i></span>
                        <span class="nxl-mtext">Academic</span>
                    </a>
                </li>
                <li class="nxl-item nxl-hasmenu">
                    <a href="{{ route('admin.facilities') }}" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-grid"></i></span>
                        <span class="nxl-mtext">Facilities</span>
                    </a>
                </li>
                <li class="nxl-item nxl-hasmenu">
                    <a href="{{ route('admin.student_life') }}" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-smile"></i></span>
                        <span class="nxl-mtext">Student Life</span>
                    </a>
                </li>
                <li class="nxl-item nxl-hasmenu">
                    <a href="{{ route('admin.information') }}" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-file-text"></i></span>
                        <span class="nxl-mtext">Information</span>
                    </a>
                </li>
                <li class="nxl-item nxl-hasmenu">
                    <a href="{{ route('admin.contact') }}" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-phone"></i></span>
                        <span class="nxl-mtext">Contact</span>
                    </a>
                </li>
                <li class="nxl-item nxl-hasmenu">
                    <a href="{{ route('teachers.index') }}" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-users"></i></span>
                        <span class="nxl-mtext">Teachers</span>
                    </a>
                </li>
                <li class="nxl-item nxl-hasmenu">
                    <a href="{{ route('students.index') }}" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-user"></i></span>
                        <span class="nxl-mtext">Students</span>
                    </a>
                </li>
                <li class="nxl-item nxl-hasmenu">
                    <a href="{{ route('admin.ppdb.index') }}" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-user-plus"></i></span>
                        <span class="nxl-mtext">PPDB</span>
                    </a>
                </li>

                <li class="nxl-item nxl-caption">
                    <label>Frontend</label>
                </li>
                <li class="nxl-item nxl-hasmenu">
                    <a href="{{ route('front.home') }}" class="nxl-link" target="_blank">
                        <span class="nxl-micon"><i class="feather-external-link"></i></span>
                        <span class="nxl-mtext">Preview Website</span>
                    </a>
                </li>

                <li class="nxl-item nxl-caption">
                    <label>Settings</label>
                </li>
                <li class="nxl-item nxl-hasmenu">
                    <a href="{{ route('admin.settings.logo.edit') }}" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-image"></i></span>
                        <span class="nxl-mtext">Logo</span>
                    </a>
                </li>
                <li class="nxl-item nxl-hasmenu">
                    <a href="{{ route('profile.edit') }}" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-user"></i></span>
                        <span class="nxl-mtext">Profile</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
