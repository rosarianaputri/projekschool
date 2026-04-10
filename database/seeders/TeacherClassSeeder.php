<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TeacherClass;
use App\Models\User;

class TeacherClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil teacher pertama atau buat jika belum ada
        $teacher = User::where('role', 'teacher')->first();
        if (!$teacher) {
            $teacher = User::factory()->create([
                'name' => 'Guru Demo',
                'email' => 'guru@demo.com',
                'role' => 'teacher',
            ]);
        }

        $classes = [
            [
                'teacher_id' => $teacher->teacher?->id ?? 1,
                'name' => 'X IPA 1',
                'subject' => 'Matematika',
                'semester' => '1',
                'schedule' => 'Senin, 07:00 - 08:30',
                'room' => 'Lab Matematika',
            ],
            [
                'teacher_id' => $teacher->teacher?->id ?? 1,
                'name' => 'X IPA 2',
                'subject' => 'Fisika',
                'semester' => '1',
                'schedule' => 'Selasa, 08:30 - 10:00',
                'room' => 'Lab Fisika',
            ],
            [
                'teacher_id' => $teacher->teacher?->id ?? 1,
                'name' => 'XI IPA 1',
                'subject' => 'Kimia',
                'semester' => '2',
                'schedule' => 'Rabu, 10:00 - 11:30',
                'room' => 'Lab Kimia',
            ],
            [
                'teacher_id' => $teacher->teacher?->id ?? 1,
                'name' => 'XI IPA 2',
                'subject' => 'Biologi',
                'semester' => '2',
                'schedule' => 'Kamis, 07:00 - 08:30',
                'room' => 'Lab Biologi',
            ],
            [
                'teacher_id' => $teacher->teacher?->id ?? 1,
                'name' => 'XII IPA 1',
                'subject' => 'Bahasa Inggris',
                'semester' => '1',
                'schedule' => 'Jumat, 08:30 - 10:00',
                'room' => 'Ruang 101',
            ],
            [
                'teacher_id' => $teacher->teacher?->id ?? 1,
                'name' => 'XII IPA 2',
                'subject' => 'Bahasa Indonesia',
                'semester' => '1',
                'schedule' => 'Senin, 10:00 - 11:30',
                'room' => 'Ruang 102',
            ],
            [
                'teacher_id' => $teacher->teacher?->id ?? 1,
                'name' => 'X IPS 1',
                'subject' => 'Sejarah',
                'semester' => '2',
                'schedule' => 'Selasa, 13:00 - 14:30',
                'room' => 'Ruang 201',
            ],
            [
                'teacher_id' => $teacher->teacher?->id ?? 1,
                'name' => 'XI IPS 1',
                'subject' => 'Ekonomi',
                'semester' => '1',
                'schedule' => 'Rabu, 14:30 - 16:00',
                'room' => 'Ruang 202',
            ],
        ];

        foreach ($classes as $classData) {
            TeacherClass::create($classData);
        }
    }
}