<?php

use App\Models\User;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('app:post-deploy {--seed : Jalankan db:seed setelah migrate} {--admin-email= : Email admin deploy} {--admin-password= : Password admin deploy} {--admin-name=Administrator : Nama admin deploy}', function () {
    $this->components->info('Menjalankan optimize:clear ...');
    $this->call('optimize:clear');

    $this->components->info('Menjalankan migrate --force ...');
    $this->call('migrate', ['--force' => true]);

    if ($this->option('seed')) {
        $this->components->info('Menjalankan db:seed --force ...');
        $this->call('db:seed', ['--force' => true]);
    }

    $adminEmail = trim((string) ($this->option('admin-email') ?: env('DEPLOY_ADMIN_EMAIL', '')));
    $adminPassword = (string) ($this->option('admin-password') ?: env('DEPLOY_ADMIN_PASSWORD', ''));
    $adminName = trim((string) ($this->option('admin-name') ?: env('DEPLOY_ADMIN_NAME', 'Administrator')));

    if ($adminEmail !== '' && $adminPassword !== '') {
        $user = User::query()->whereRaw('LOWER(email) = ?', [strtolower($adminEmail)])->first();

        if (! $user) {
            $user = User::query()->whereRaw('LOWER(role) = ?', ['admin'])->first();
        }

        if (! $user) {
            $user = new User();
        }

        $user->name = $adminName !== '' ? $adminName : 'Administrator';
        $user->email = strtolower($adminEmail);
        $user->password = Hash::make($adminPassword);
        $user->role = 'admin';

        if (! $user->email_verified_at) {
            $user->email_verified_at = now();
        }

        $user->save();

        $this->components->info('Akun admin tersinkron: '.$user->email);
    } else {
        $this->components->warn('Sinkron admin dilewati (DEPLOY_ADMIN_EMAIL/PASSWORD belum diisi).');
    }

    $this->components->info('Post-deploy selesai.');
})->purpose('Standarisasi state aplikasi setelah pull/deploy agar konsisten dengan lokal');
