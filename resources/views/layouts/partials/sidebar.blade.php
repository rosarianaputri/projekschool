<nav class="nxl-navigation">
    @php
        // Ambil logo dari pengaturan
        $logoPath = \App\Models\SiteSetting::getValue('school_logo');
        $logoUrl = $logoPath ? asset($logoPath) : asset('images/default-logo.png');
    @endphp

    <div class="navbar-wrapper">
        <div class="m-header" style="display: none; align-items: center; justify-content: center; height: 70px;">
            <a href="{{ route('dashboard') }}" class="b-brand" style="display: flex; align-items: center; justify-content: center; padding: 8px 12px;">
                <img src="{{ $logoUrl }}" alt="Logo" class="logo logo-lg" style="max-height: 90px; width: auto; object-fit: contain;" />
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
                        <span class="nxl-mtext">Dashboard</span>
                    </a>
                </li>

                @if(auth()->user()->role === 'admin')
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
                @elseif(auth()->user()->role === 'teacher')
                    <li class="nxl-item nxl-hasmenu">
                        <a href="{{ route('teacher.classes.index') }}" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-book-open"></i></span>
                            <span class="nxl-mtext">Kelas</span>
                        </a>
                    </li>
                    <li class="nxl-item nxl-hasmenu">
                        <a href="{{ route('teacher.students.index') }}" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-users"></i></span>
                            <span class="nxl-mtext">Siswa</span>
                        </a>
                    </li>
                    <li class="nxl-item nxl-hasmenu">
                        <a href="{{ route('teacher.attendance.index') }}" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-check-circle"></i></span>
                            <span class="nxl-mtext">Absensi</span>
                        </a>
                    </li>
                    <li class="nxl-item nxl-hasmenu">
                        <a href="{{ route('teacher.grades.index') }}" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-award"></i></span>
                            <span class="nxl-mtext">Nilai</span>
                        </a>
                    </li>
                    <li class="nxl-item nxl-hasmenu">
                        <a href="{{ route('teacher.assignments.index') }}" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-file-text"></i></span>
                            <span class="nxl-mtext">Tugas</span>
                        </a>
                    </li>
                    <li class="nxl-item nxl-hasmenu">
                        <a href="{{ route('teacher.materials.index') }}" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-folder"></i></span>
                            <span class="nxl-mtext">Materi</span>
                        </a>
                    </li>
                    <li class="nxl-item nxl-hasmenu">
                        <a href="{{ route('teacher.schedule.index') }}" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-calendar"></i></span>
                            <span class="nxl-mtext">Jadwal</span>
                        </a>
                    </li>
                    <li class="nxl-item nxl-hasmenu">
                        <a href="{{ route('teacher.reports.index') }}" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-bar-chart"></i></span>
                            <span class="nxl-mtext">Laporan</span>
                        </a>
                    </li>

                    @php
                        $teacher = auth()->user()->teacher;
                        $classes = $teacher ? $teacher->classes : collect();
                        $totalStudents = $teacher ? $teacher->students->count() : 0;
                    @endphp

                    <li class="nxl-item nxl-caption">
                        <label>Informasi Kelas</label>
                    </li>

                    @if($classes->count() > 0)
                        @foreach($classes as $class)
                            <li class="nxl-item">
                                <div class="nxl-link" style="padding: 8px 15px;">
                                    <span class="nxl-micon"><i class="feather-book"></i></span>
                                    <div style="display: flex; flex-direction: column; flex: 1;">
                                        <span class="nxl-mtext" style="font-size: 12px; font-weight: 600;">{{ $class->name }}</span>
                                        <span style="font-size: 11px; color: #6c757d;">{{ $class->subject }} • {{ $class->students->count() }}/36 siswa</span>
                                    </div>
                                </div>
                            </li>
                        @endforeach

                        <li class="nxl-item">
                            <div class="nxl-link" style="padding: 8px 15px; background-color: #f8f9fa; border-radius: 4px;">
                                <span class="nxl-micon"><i class="feather-users" style="color: #007bff;"></i></span>
                                <div style="display: flex; flex-direction: column; flex: 1;">
                                    <span class="nxl-mtext" style="font-size: 12px; font-weight: 600; color: #007bff;">Total Siswa</span>
                                    <span style="font-size: 13px; font-weight: bold; color: #007bff;">{{ $totalStudents }} siswa</span>
                                </div>
                            </div>
                        </li>
                    @else
                        <li class="nxl-item">
                            <div class="nxl-link" style="padding: 8px 15px;">
                                <span class="nxl-micon"><i class="feather-info"></i></span>
                                <span class="nxl-mtext" style="font-size: 12px;">Belum ada kelas</span>
                            </div>
                        </li>
                    @endif

                @elseif(auth()->user()->role === 'student')
                    <li class="nxl-item nxl-hasmenu">
                        <a href="{{ route('student.dashboard') }}" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-home"></i></span>
                            <span class="nxl-mtext">Dashboard Siswa</span>
                        </a>
                    </li>
                @endif

                <li class="nxl-item nxl-caption">
                    <label>Frontend</label>
                </li>
                <li class="nxl-item nxl-hasmenu">
                    <a href="{{ route('front.home') }}" class="nxl-link" target="_blank">
                        <span class="nxl-micon"><i class="feather-external-link"></i></span>
                        <span class="nxl-mtext">Preview Website</span>
                    </a>
                </li>

                @if(auth()->user()->role === 'admin')
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
                        <a href="{{ route('admin.settings.footer.edit') }}" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-layout"></i></span>
                            <span class="nxl-mtext">Footer</span>
                        </a>
                    </li>
                @endif
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
