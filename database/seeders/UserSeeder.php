<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        // doctor
        User::create([
            'name' => 'Dr. B Care',
            'email' => 'doctor@binus.ac.id',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), 
            'role' => User::ROLE_DOCTOR,
            'remember_token' => Str::random(10),
        ]);

        // student
        User::create([
            'name' => 'Binusian Test',
            'email' => 'student@binus.ac.id',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), 
            'role' => User::ROLE_STUDENT,
            'remember_token' => Str::random(10),
        ]);

        // generic student
        User::factory(5)->create(['role' => User::ROLE_STUDENT]);
    }
}
