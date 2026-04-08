<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\Student\PpdbController as StudentPpdbController;
use App\Http\Controllers\Student\UploadController;
use App\Http\Controllers\Student\StatusController;
use App\Http\Controllers\Teacher\AssignmentController;
use App\Http\Controllers\Teacher\AttendanceController;
use App\Http\Controllers\Teacher\ClassController;
use App\Http\Controllers\Teacher\DashboardController as TeacherDashboardController;
use App\Http\Controllers\Teacher\GradeController;
use App\Http\Controllers\Teacher\MaterialController;
use App\Http\Controllers\Teacher\ReportController;
use App\Http\Controllers\Teacher\ScheduleController;
use App\Http\Controllers\Teacher\StudentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Admin\SitePageController;
use App\Http\Controllers\Admin\PpdbController as AdminPpdbController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\StudentController as AdminStudentController;
use App\Http\Controllers\frontend\PpdbController;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;

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

Route::get('/dashboard', function (Request $request) {
    $user = $request->user();
    return redirect()->to($user->dashboardPath());
})->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('teachers', TeacherController::class);
    Route::resource('students', AdminStudentController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:teacher'])->prefix('teacher')->name('teacher.')->group(function () {
    Route::get('/dashboard', [TeacherDashboardController::class, 'index'])->name('dashboard');

    Route::resource('classes', ClassController::class)->parameters(['classes' => 'teacher_class'])->except(['show']);
    Route::resource('students', StudentController::class)->except(['show']);
    Route::resource('attendance', AttendanceController::class)->parameters(['attendance' => 'teacher_attendance'])->except(['show']);
    Route::resource('grades', GradeController::class)->parameters(['grades' => 'teacher_grade'])->except(['show']);
    Route::resource('assignments', AssignmentController::class)->parameters(['assignments' => 'teacher_assignment'])->except(['show']);
    Route::resource('materials', MaterialController::class)->parameters(['materials' => 'teacher_material'])->except(['show']);
    Route::resource('schedule', ScheduleController::class)->parameters(['schedule' => 'teacher_schedule'])->except(['show']);
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
});

Route::middleware(['auth','role:student'])->group(function () {
    Route::get('/student/dashboard', [StudentDashboardController::class, 'index'])->name('student.dashboard');

    Route::get('/student/upload', [UploadController::class, 'index'])->name('student.upload');
    Route::post('/student/upload', [UploadController::class, 'store'])->name('student.upload.store');

    Route::get('/student/status', [StatusController::class, 'index'])->name('student.status');

    Route::get('/student/ppdb', [StudentPpdbController::class, 'index'])->name('student.ppdb.index');
    Route::get('/student/ppdb/formulir', [StudentPpdbController::class, 'create'])->name('student.formulir');
    Route::post('/student/ppdb/formulir', [StudentPpdbController::class, 'store'])->name('student.ppdb.store');
});

require __DIR__.'/auth.php';