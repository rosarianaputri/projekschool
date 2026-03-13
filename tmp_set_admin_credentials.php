<?php

require __DIR__ . '/vendor/autoload.php';

$app = require __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

$email = 'admin@gmail.com';
$password = 'password';

$user = User::query()->where('email', $email)->first();

if (! $user) {
    $user = User::query()->where('role', 'admin')->first();
}

if (! $user) {
    $user = new User();
    $user->name = 'Administrator';
}

$user->email = $email;
$user->password = Hash::make($password);
$user->role = 'admin';
$user->save();

echo "Admin credentials updated" . PHP_EOL;
echo "Email: {$user->email}" . PHP_EOL;
echo "Role: {$user->role}" . PHP_EOL;
echo "Password check: " . (Hash::check($password, $user->password) ? 'OK' : 'FAILED') . PHP_EOL;
