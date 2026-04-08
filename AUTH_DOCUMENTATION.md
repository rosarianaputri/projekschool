# 📚 Dokumentasi Sistem Autentikasi - LaylaSchool

## ✅ Status Perbaikan (April 6, 2026)

### Masalah yang Diperbaiki:
1. ✅ **Portal Admin Ditambahkan** - Sekarang ada 3 portal login (Admin, Guru, Siswa)
2. ✅ **Tampilan Diperbaiki** - UI modern dengan Poppins font dan colors yang konsisten
3. ✅ **Registrasi untuk Guru & Siswa** - Form registrasi dengan validasi dan error handling
4. ✅ **Sistem Role/Peran** - Setiap user memiliki role yang jelas dan divalidasi saat login
5. ✅ **Code Refactoring** - Shared methods di base Controller untuk menghindari duplikasi

---

## 🔐 Sistem Autentikasi

### 3 Portal Login dengan Role Berbeda:

| Portal | Route | Role | Dashboard | Deskripsi |
|--------|-------|------|-----------|-----------|
| **Admin** | `/login/admin` | `admin` | `/admin/home` | Kelola site, pengguna, settings |
| **Guru** | `/login/guru` | `teacher` | `/teacher/dashboard` | Kelola data siswa, upload dokumen |
| **Siswa** | `/login/siswa` | `student` | `/student/dashboard` | Submit PPDB, upload, cek status |

---

## 🔗 URL Penting

### Login & Register
```
GET  /login                    → Pilih portal login (Admin, Guru, Siswa)
GET  /login/admin              → Form login Admin
GET  /login/guru               → Form login Guru  
GET  /login/siswa              → Form login Siswa
GET  /register                 → Pilih portal register (Guru, Siswa)
GET  /register/guru            → Form register Guru
GET  /register/siswa           → Form register Siswa
POST /logout                   → Logout
```

### Dashboard
```
GET /dashboard                 → Auto-redirect ke dashboard sesuai role
```

---

## 📋 Alur Login (Login Flow)

```
┌─────────────────┐
│ Kunjungi /login │
└────────┬────────┘
         │
         ▼
┌──────────────────────────┐
│ Pilih Portal Login:      │
│ • Portal Admin           │ ──────────┐
│ • Portal Guru            │ ──────────┤
│ • Portal Siswa           │ ──────────┤
└──────────────────────────┘           │
                                       │
         ┌─────────────────────────────┘
         │
         ▼
┌──────────────────────────────────┐
│ Masukkan Email & Password        │
│ 📧 Email:          [________]    │
│ 🔒 Password:       [________]    │
│ ☑ Ingat saya       [✓]           │
│                                  │
│    [Masuk ke Portal X]           │
└──────────────────────────────────┘
         │
         ▼
┌──────────────────────────────┐
│ Validasi:                    │
│ 1. Email valid?              │
│ 2. Password tepat?           │
│ 3. Role sesuai portal?       │
└──────────────────────────────┘
         │
    ┌────┴─────┐
    │           │
   ✅ YA       ❌ TIDAK
    │           │
    ▼           ▼
┌────────────┐  ┌─────────────────────┐
│ Login OK  │   │ Tampilkan Error:    │
│ Session   │   │ • Email salah       │
│ dibuat    │   │ • Password salah    │
└────┬───────┘  │ • Akun bukan role   │
     │          │   ini               │
     ▼          └─────────────────────┘
┌──────────────────┐
│ Redirect ke:     │
│ /admin/home      │ (untuk admin)
│ /teacher/... │ (untuk guru)
│ /student/... │ (untuk siswa)
└──────────────────┘
```

---

## 📝 Alur Registrasi (Register Flow)

```
┌────────────────────────┐
│ Kunjungi /register     │
└────────┬────────────────┘
         │
         ▼
┌──────────────────────────────┐
│ Pilih Portal Register:       │
│ • Portal Register Guru       │
│ • Portal Register Siswa      │
│                              │
│ (Admin tidak ada - dibuat    │
│  manual oleh Admin lain)     │
└──────────────────────────────┘
         │
         ▼
┌──────────────────────────────────┐
│ Form Registrasi Guru/Siswa:      │
│                                  │
│ 👤 Nama Lengkap: [_______]       │
│ 📧 Email:        [_______]       │
│ 🔒 Password:     [_______]       │
│ 🔒 Konfirmasi:   [_______]       │
│                                  │
│    [Daftar Sekarang]             │
└──────────────────────────────────┘
         │
         ▼
┌──────────────────────────────────┐
│ Validasi Form:                   │
│ • Nama diisi?                    │
│ • Email valid & unik?            │
│ • Password ≥ 8 karakter?         │
│ • Password konfirmasi sama?      │
│ • Password ada huruf+angka+     │
│   simbol?                        │
└──────────────────────────────────┘
         │
    ┌────┴─────┐
   ✅ OK   ❌ ERROR
    │          │
    ▼          ▼
┌────────┐ ┌─────────────────────┐
│ Buat  │  │ Tampilkan Error:    │
│ User  │  │ • Nama diperlukan   │
│       │  │ • Email sudah ada   │
│ Set   │  │ • Password lemah    │
│ Role  │  │ • Konfirmasi salah  │
└───┬───┘  └─────────────────────┘
    │
    ▼
┌──────────────────┐
│ Auto-Login       │
│ + Session        │
└───┬──────────────┘
    │
    ▼
┌──────────────────────┐
│ Redirect ke:         │
│ /teacher/dashboard   │ (Guru)
│ /student/dashboard   │ (Siswa)
└──────────────────────┘
```

---

## 🎨 Tampilan UI (User Interface)

### Portal Selector (Login & Register)
```
┌────────────────────────────────────────────────────────────┐
│                                                             │
│  Pilih Portal Login / Register                             │
│  [Daftar akun sesuai dengan peran Anda]                   │
│                                                             │
│  ┌──────────────┐  ┌──────────────┐  ┌──────────────┐    │
│  │ 🛡️ Portal   │  │ 👨‍🎓 Portal  │  │ 👨‍🏫 Portal   │    │
│  │   Admin      │  │   Siswa      │  │   Guru       │    │
│  └──────────────┘  └──────────────┘  └──────────────┘    │
│                                                             │
│  Sudah punya akun? Masuk di sini                           │
│                                                             │
└────────────────────────────────────────────────────────────┘
```

### Login Form (Role-Specific)
```
┌──────────────────────────────────────┐
│ 🛡️ Portal Admin                       │
│                                      │
│ Masuk Admin                          │
│ Gunakan akun dengan role admin       │
│ untuk melanjutkan.                   │
│                                      │
│ 📧 Email                            │
│ [_____________________________]       │
│                                      │
│ 🔒 Password                         │
│ [_____________________________]       │
│                                      │
│ ☑ Ingat saya                        │
│                                      │
│ [Masuk ke Portal Admin]              │
│                                      │
│ Pilih portal lain | Lupa password?   │
└──────────────────────────────────────┘
```

### Register Form (Guru/Siswa)
```
┌──────────────────────────────────────┐
│ 👨‍🏫 Daftar Guru                       │
│                                      │
│ Buat Akun                            │
│ Bergabunglah dengan portal guru kami │
│                                      │
│ 👤 Nama Lengkap                     │
│ [_____________________________]       │
│                                      │
│ 📧 Email                            │
│ [_____________________________]       │
│                                      │
│ 🔒 Password                         │
│ [_____________________________]       │
│ Password harus min. 8 karakter       │
│                                      │
│ 🔒 Konfirmasi Password              │
│ [_____________________________]       │
│                                      │
│ [Daftar Sekarang]                    │
│                                      │
│ Sudah punya akun? Masuk di sini      │
└──────────────────────────────────────┘
```

---

## 🔒 Keamanan (Security)

### Password Requirements:
- ✅ Minimal 8 karakter
- ✅ Harus mengandung huruf (uppercase & lowercase)
- ✅ Harus mengandung angka
- ✅ Harus mengandung simbol (!@#$%^&*)
- ✅ Hash: Bcrypt (otomatis di-hash saat disimpan)

### Security Features:
1. **Role Validation** - Login mengecek role user sesuai portal
2. **Rate Limiting** - Max 5 percobaan login per menit (per IP+email)
3. **CSRF Protection** - Semua form punya @csrf token
4. **Session Protection** - Token regenerate setelah login
5. **Password Hashing** - Bcrypt encryption di database

### Error Messages:
```
❌ "Email tidak ditemukan"                  → Email tidak terdaftar
❌ "Email atau password salah"              → Password salah
❌ "Akun ini bukan untuk portal Admin"      → User bukan admin
❌ "Terlalu banyak percobaan login"         → Rate limit (tunggu 60s)
❌ Password lemah → Tidak ada huruf/angka/simbol
❌ Email sudah ada → Sudah terdaftar
```

---

## 📂 File Yang Diubah

### Backend (Controllers & Config)

#### `app/Http/Controllers/Controller.php` ✏️ DIUBAH
```PHP
// Ditambah helper methods:
- normalizeRole($role)     // 'guru' → 'teacher', 'siswa' → 'student'
- roleLabel($role)         // 'teacher' → 'Guru', 'student' → 'Siswa'
```

#### `app/Http/Controllers/Auth/AuthenticatedSessionController.php` ✏️ DIUBAH
```PHP
- Removed: duplicate normalizeRole() & roleLabel()
- Now: inherits dari Controller
- Handles: Role-based login validation
```

#### `app/Http/Controllers/Auth/RegisteredUserController.php` ✏️ DIUBAH
```PHP
- Removed: duplicate normalizeRole() & roleLabel()
- Now: inherits dari Controller
- Handles: Role-based registration
```

### Frontend (Views)

#### `resources/views/auth/login.blade.php` ✨ REDESIGNED
```
- ✅ Added Admin portal card
- ✅ Grid: 3 columns → 2 columns (tablet) → 1 column (mobile)
- ✅ Modern styling konsisten
- ✅ FontAwesome icons untuk setiap portal
```

#### `resources/views/auth/login-role.blade.php` ✅ EXISTING
```
- Role-specific form sudah bagus
- Error handling sudah ada
- Responsive design sudah OK
```

#### `resources/views/auth/register-portal.blade.php` ✨ IMPROVED
```
- ✅ Added subtitle untuk better UX
- ✅ Improved styling consistency
- ✅ Better visual hierarchy
- ✅ Responsive design
```

#### `resources/views/auth/register.blade.php` ✨ REDESIGNED
```
- ✅ Complete modern redesign
- ✅ Role-specific chip badge
- ✅ Improved form styling dengan focus states
- ✅ Enhanced error display (semua errors ditampilkan)
- ✅ Password strength hint
- ✅ Mobile responsive
```

---

## 🧪 Testing Panduan

### Test 1: Admin Login
```
1. Buka: http://localhost/login
2. Klik: Portal Admin
3. Input: email admin, password admin
4. Result: Redirect ke /admin/home
```

### Test 2: Siswa Registration
```
1. Buka: http://localhost/register
2. Klik: Portal Register Siswa
3. Input: 
   - Nama: Budi Santoso
   - Email: budi@school.com
   - Password: Admin@12345
   - Confirm: Admin@12345
4. Klik: Daftar Sekarang
5. Result: Auto-login ke /student/dashboard
```

### Test 3: Guru Login
```
1. Buka: http://localhost/login
2. Klik: Portal Guru
3. Input: email guru, password guru
4. Result: Redirect ke /teacher/dashboard
```

### Test 4: Role Validation
```
1. Create Siswa dengan email: siswa@test.com
2. Try login di Portal Guru dengan email siswa@test.com
3. Result: Error "Akun ini bukan untuk portal Guru"
```

### Test 5: Wrong Credentials
```
1. Buka: /login/siswa
2. Input: valid email, salah password
3. Result: Error "Email atau password salah"
```

---

## 🛠️ Database Schema

### Users Table
```SQL
CREATE TABLE users (
    id BIGINT UNSIGNED PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    email_verified_at TIMESTAMP,
    password VARCHAR(255) NOT NULL,     -- Bcrypt hash
    role ENUM('admin', 'teacher', 'student'),
    remember_token VARCHAR(100),
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

### Role Values:
```
'admin'   → Administrator
'teacher' → Guru
'student' → Siswa
```

---

## 🚀 Route Diagram

```
GET  /                              → Frontend Home
GET  /home                          → Frontend Home
GET  /about, /academic, dll         → Frontend Pages

━━━━━━━━━━━━━ AUTH ROUTES ━━━━━━━━━━━━━
GET  /login                         → Portal Selector
GET  /login/{admin|guru|siswa}      → Role Login Form
POST /login/{admin|guru|siswa}      → Process Login
GET  /register                      → Portal Selector
GET  /register/{guru|siswa}         → Role Register Form
POST /register/{guru|siswa}         → Process Register
POST /logout                        → Logout

━━━━━━━━━ ADMIN ROUTES (protected) ━━━━━━
GET  /admin/home                    → Admin Dashboard
GET  /admin/settings/logo           → Edit Logo
POST /admin/settings/logo
GET  /admin/pages/{slug}            → Edit Pages
POST /admin/pages/{slug}
...

━━━━━━ TEACHER ROUTES (protected) ━━━━━
GET  /teacher/dashboard             → Teacher Dashboard
...

━━━━━━ STUDENT ROUTES (protected) ━━━━━
GET  /student/dashboard             → Student Dashboard
GET  /ppdb/form                     → PPDB Form
POST /ppdb/form
...
```

---

## 💡 Tips & Trik

### Cara Membuat Admin Baru (Manual):
```PHP
// Jalankan di:
- Tinker: php artisan tinker
- Seed: Edit DatabaseSeeder.php
- Manual SQL: INSERT INTO users...

Contoh Tinker:
> User::create([
    'name' => 'Admin Baru',
    'email' => 'admin@school.com',
    'password' => bcrypt('Password@123'),
    'role' => 'admin'
  ])
```

### Cara Reset Password User:
```PHP
> $user = User::find(1);
> $user->password = bcrypt('NewPassword@123');
> $user->save();
```

### Debugging Login Issues:
1. Check: Database user ada?
   ```
   SELECT * FROM users WHERE email='test@test.com';
   ```

2. Check: Role user sesuai?
   ```
   SELECT email, role FROM users WHERE email='guru@test.com';
   ```

3. Check: Password hash benar?
   ```PHP
   Hash::check('password', $user->password);
   ```

4. Check: Session active?
   ```PHP
   dd(auth()->user());
   ```

---

## 📞 Troubleshooting

### Problem: Login redirect loop
**Solution**: Check session/cookies setting di .env

### Problem: CSRF token mismatch
**Solution**: Clear browser cookies & cache

### Problem: Password tidak accepted
**Solution**: Password harus 8+ karakter dengan huruf, angka, simbol

### Problem: Admin portal tidak muncul
**Solution**: Clear browser cache (Ctrl+Shift+Delete)

### Problem: Email already exists error saat register
**Solution**: Email sudah terdaftar, gunakan email lain

---

## 📊 User Role Comparison

| Feature | Admin | Guru | Siswa |
|---------|-------|------|-------|
| Login | ✅ | ✅ | ✅ |
| Register | ⚠️ Manual | ✅ | ✅ |
| Dashboard | ✅ Admin | ✅ Teacher | ✅ Student |
| Edit Pages | ✅ | ❌ | ❌ |
| Kelola Siswa | ✅ | ✅ | ❌ |
| Submit PPDB | ❌ | ❌ | ✅ |
| View PPDB | ✅ | ❌ | ✅ |

---

## 📝 Catatan & Release Notes

### Version 2.0 (6 April 2026) - Authentication System Update
✅ **Fixed:**
- Added Admin portal to login page
- Improved UI for all auth pages
- Refactored controller code (DRY principle)
- Enhanced form validation & error handling
- Mobile responsive design

✅ **Improved:**
- Modern color scheme & styling
- Role-specific chip badges
- Better error messages
- Password strength hints
- User experience flow

✅ **Added:**
- Subtitle in register portal
- Focus states pada form inputs
- All error messages di display dengan proper format

---

## 🤝 Support & Contact

For issues atau pertanyaan tentang sistem autentikasi:
1. Check dokumentasi ini terlebih dahulu
2. Jalankan tests sesuai Testing Panduan
3. Contact DevOps/Admin team

---

**Last Updated:** April 6, 2026
**System:** Laravel 11 + Breeze Authentication
**Status:** ✅ Production Ready
