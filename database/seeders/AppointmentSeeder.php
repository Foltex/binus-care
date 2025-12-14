<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Database\Seeder;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testStudentId = User::where('email', 'student@binus.ac.id')->value('id');

        // Pending Appointment (Requires Doctor action)
        Appointment::create([
            'user_id' => $testStudentId,
            'type' => 'psychology',
            'scheduled_at' => now()->addDays(2)->setHour(10)->setMinute(0),
            'notes' => 'Merasa cemas dan sulit tidur karena tugas akhir.',
            'status' => 'pending',
        ]);

        // Confirmed Appointment 
        Appointment::create([
            'user_id' => $testStudentId,
            'type' => 'medical',
            'scheduled_at' => now()->addDays(5)->setHour(14)->setMinute(30),
            'notes' => 'Perlu cek tekanan darah rutin.',
            'status' => 'confirmed',
        ]);
        
        // Completed Appointment
        Appointment::create([
            'user_id' => $testStudentId,
            'type' => 'psychology',
            'scheduled_at' => now()->subDays(10), // In the past
            'notes' => 'Initial consultation for anxiety.',
            'status' => 'completed',
        ]);
    }
}
