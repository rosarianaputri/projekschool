<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Student\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Admin\SitePageController;
use App\Http\Controllers\Admin\PpdbController as AdminPpdbController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\StudentController;   
use App\Http\Controllers\frontend\PpdbController;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\AdminStudentLifeController;

Route::get('/', function () {
    return redirect()->route('front.home');
});

Route::get('migrate', function() {
   Artisan::call('migrate');
   dd(Artisan::output());
});


Route::get('/home', [FrontendController::class, 'page'])->defaults('slug', 'home')->name('front.home');
Route::get('/about', [FrontendController::class, 'page'])->defaults('slug', 'about')->name('front.about');
Route::get('/academic', [FrontendController::class, 'page'])->defaults('slug', 'academic')->name('front.academic');
Route::get('/facilities', [FrontendController::class, 'page'])->defaults('slug', 'facilities')->name('front.facilities');
Route::get('/student-life', [FrontendController::class, 'page'])->defaults('slug', 'student-life')->name('front.student_life');
Route::get('/information', [FrontendController::class, 'page'])->defaults('slug', 'information')->name('front.information');
Route::get('/contact', [FrontendController::class, 'page'])->defaults('slug', 'contact')->name('front.contact');
Route::get('/ppdb', [PpdbController::class, 'index'])->name('front.ppdb');
Route::get('/ppdb/formulir', [PpdbController::class, 'create'])->name('front.ppdb.form');
Route::post('/ppdb/formulir', [PpdbController::class, 'store'])->name('front.ppdb.store');
Route::get('/ppdb/search', [PpdbController::class, 'search'])->name('front.ppdb.search');

// News article routes
Route::get('/news-liblary', function () {
    return view('frontend.news-liblary');
})->name('front.news-liblary');

Route::get('/news-fair-sains', function () {
    return view('frontend.news-fair-sains');
})->name('front.news-fair-sains');

Route::get('/news-art', function () {
    return view('frontend.news-art');
})->name('front.news-art');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/settings/logo', [SiteSettingController::class, 'editLogo'])->name('settings.logo.edit');
    Route::post('/settings/logo', [SiteSettingController::class, 'updateLogo'])->name('settings.logo.update');

    Route::get('/pages/{slug}', [SitePageController::class, 'edit'])->name('pages.edit');
    Route::post('/pages/{slug}', [SitePageController::class, 'update'])->name('pages.update');
    Route::post('/pages/{slug}/reset', [SitePageController::class, 'reset'])->name('pages.reset');
    Route::delete('/pages/{slug}', [SitePageController::class, 'destroy'])->name('pages.destroy');

    Route::get('/home', [SiteSettingController::class, 'editHome'])->name('home');
    Route::post('/home', [SiteSettingController::class, 'updateHome'])->name('home.update');
    Route::post('/home/reset', [SiteSettingController::class, 'resetHome'])->name('home.reset');
    Route::delete('/home', [SiteSettingController::class, 'destroyHome'])->name('home.destroy');
    Route::get('/about', [SiteSettingController::class, 'editAbout'])->name('about');
    Route::post('/about', [SiteSettingController::class, 'updateAbout'])->name('about.update');
    Route::post('/about/reset', [SiteSettingController::class, 'resetAbout'])->name('about.reset');
    Route::delete('/about', [SiteSettingController::class, 'destroyAbout'])->name('about.destroy');
    Route::get('/academic', [SiteSettingController::class, 'editAcademic'])->name('academic');
    Route::post('/academic', [SiteSettingController::class, 'updateAcademic'])->name('academic.update');
    Route::post('/academic/reset', [SiteSettingController::class, 'resetAcademic'])->name('academic.reset');
    Route::delete('/academic', [SiteSettingController::class, 'destroyAcademic'])->name('academic.destroy');
    Route::get('/facilities', [SiteSettingController::class, 'editFacilities'])->name('facilities');
    Route::post('/facilities', [SiteSettingController::class, 'updateFacilities'])->name('facilities.update');
    Route::post('/facilities/reset', [SiteSettingController::class, 'resetFacilities'])->name('facilities.reset');
    Route::delete('/facilities', [SiteSettingController::class, 'destroyFacilities'])->name('facilities.destroy');
    Route::get('/student-life', [SiteSettingController::class, 'editStudentLife'])->name('student_life');
    Route::post('/student-life', [SiteSettingController::class, 'updateStudentLife'])->name('student_life.update');
    Route::post('/student-life/reset', [SiteSettingController::class, 'resetStudentLife'])->name('student_life.reset');
    Route::delete('/student-life', [SiteSettingController::class, 'destroyStudentLife'])->name('student_life.destroy');
    Route::get('/information', [SiteSettingController::class, 'editInformation'])->name('information');
    Route::post('/information', [SiteSettingController::class, 'updateInformation'])->name('information.update');
    Route::post('/information/reset', [SiteSettingController::class, 'resetInformation'])->name('information.reset');
    Route::delete('/information', [SiteSettingController::class, 'destroyInformation'])->name('information.destroy');
    Route::get('/contact', [SiteSettingController::class, 'editContact'])->name('contact');
    Route::post('/contact', [SiteSettingController::class, 'updateContact'])->name('contact.update');
    Route::post('/contact/reset', [SiteSettingController::class, 'resetContact'])->name('contact.reset');
    Route::delete('/contact', [SiteSettingController::class, 'destroyContact'])->name('contact.destroy');

    Route::get('/ppdb', [AdminPpdbController::class, 'index'])->name('ppdb.index');
    Route::get('/ppdb/create', [AdminPpdbController::class, 'create'])->name('ppdb.create');
    Route::post('/ppdb', [AdminPpdbController::class, 'store'])->name('ppdb.store');
    Route::get('/ppdb/{ppdbApplication}', [AdminPpdbController::class, 'show'])->name('ppdb.show');
    Route::get('/ppdb/{ppdbApplication}/edit', [AdminPpdbController::class, 'edit'])->name('ppdb.edit');
    Route::put('/ppdb/{ppdbApplication}', [AdminPpdbController::class, 'update'])->name('ppdb.update');
    Route::patch('/ppdb/{ppdbApplication}/acc', [AdminPpdbController::class, 'approve'])->name('ppdb.acc');
    Route::patch('/ppdb/{ppdbApplication}/reject', [AdminPpdbController::class, 'reject'])->name('ppdb.reject');
    Route::delete('/ppdb/{ppdbApplication}', [AdminPpdbController::class, 'destroy'])->name('ppdb.destroy');
});

Route::prefix('admin')->name('admin.')->group(function() {
    Route::get('/admin/student-life', [AdminStudentLifeController::class, 'edit'])
    ->name('admin.student_life'); // hapus ".edit"

    Route::post('/student-life/update', [AdminStudentLifeController::class, 'update'])->name('student_life.update');
    Route::post('/student-life/reset', [AdminStudentLifeController::class, 'reset'])->name('student_life.reset');
    Route::delete('/student-life/delete', [AdminStudentLifeController::class, 'destroy'])->name('student_life.destroy');
});

// Route::get('/x', function () {
//     return view('admin.index');
// })->middleware(['auth', 'verified'])->name('admin.index');

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::resource('teachers', TeacherController::class);
    Route::resource('students', StudentController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth','role:student'])->group(function () {

});

// ===========================
// Dashboard Siswa
// ===========================

Route::middleware(['auth','role:student'])->group(function () {
    // Dashboard siswa
    Route::get('/student/dashboard', [DashboardController::class, 'index'])->name('student.dashboard');

    // PPDB siswa
    Route::get('/student/ppdb', [PpdbController::class, 'index'])->name('student.ppdb.index');
    Route::get('/student/ppdb/formulir', [PpdbController::class, 'create'])->name('student.ppdb.form');
    Route::post('/student/ppdb/formulir', [PpdbController::class, 'store'])->name('student.ppdb.store');
});

require __DIR__.'/auth.php';
