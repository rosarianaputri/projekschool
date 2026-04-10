<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TeacherClass;
use App\Models\TeacherStudent;

class TeacherStudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Nama-nama siswa (36 nama)
        $firstNames = [
            'Andi', 'Budi', 'Citra', 'Dedi', 'Eka', 'Faisal', 'Gina', 'Hendra', 'Indah', 'Joko',
            'Karla', 'Lilis', 'Mikael', 'Nadia', 'Okta', 'Putra', 'Qori', 'Rina', 'Sita', 'Tama',
            'Udin', 'Vanessa', 'Wili', 'Xena', 'Yuki', 'Zahra', 'Agus', 'Bella', 'Candra', 'Diana',
            'Endra', 'Farah', 'Gilang', 'Hana', 'Irfan', 'Jasmine'
        ];

        $lastNames = [
            'Setiawan', 'Rahman', 'Kusuma', 'Wijaya', 'Santoso', 'Harjanto', 'Hartono', 'Hermawan', 'Hudayat', 'Ibrahim',
            'Jatmiko', 'Kuncoro', 'Laksana', 'Maryanto', 'Nugroho', 'Oshiro', 'Permana', 'Rachman', 'Sutrisno', 'Teguh',
            'Utama', 'Vaidhya', 'Wahyu', 'Xavier', 'Yudha', 'Zaenuri'
        ];

        // Ambil semua kelas
        $classes = TeacherClass::all();

        foreach ($classes as $class) {
            for ($i = 1; $i <= 36; $i++) {
                $firstName = $firstNames[array_rand($firstNames)];
                $lastName = $lastNames[array_rand($lastNames)];
                $nis = $class->id . sprintf('%03d', $i); // Format: class_id + 001-036
                
                TeacherStudent::create([
                    'teacher_id' => $class->teacher_id,
                    'teacher_class_id' => $class->id,
                    'name' => $firstName . ' ' . $lastName,
                    'nis' => $nis,
                    'phone' => '08' . str_pad(rand(100000000, 999999999), 9, '0', STR_PAD_LEFT),
                    'email' => strtolower($firstName . '.' . $lastName . '@student.example.com'),
                    'notes' => null,
                ]);
            }
        }

        echo 'TeacherStudent seeder completed: ' . count($classes) . ' classes with 36 students each.';
    }
}
