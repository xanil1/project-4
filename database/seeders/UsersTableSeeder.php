<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        // Verwijder alle gebruikers en hun rollen
        User::truncate();
        DB::table('role_user')->truncate();

        // Haal de rollen 'admin' en 'student' op
        $adminRole = Role::where('name', 'admin')->first();
        $studentRole = Role::where('name', 'student')->first();

        // Maak de admin gebruiker aan
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin2@gmail.com',
            'password' => Hash::make('12345678')
        ]);

        // Maak de student gebruiker aan
        $student = User::create([
            'name' => 'Student',
            'email' => 'student@gmail.com',
            'password' => Hash::make('12345678')
        ]);

        // Maak een lijst van klanten en koppel de rol 'student'
        $users = [
            [
                'name' => 'Anil',
                'email' => 'anil@gmail.com',
                'password' => Hash::make('12345678')
            ],
            [
                'name' => 'Test',
                'email' => 'test@gmail.com',
                'password' => Hash::make('12345678')
            ],
        ];

        foreach ($users as $userData) {
            $user = User::create($userData);
            $user->roles()->attach($studentRole); // Koppel de student rol
        }

        // Koppel de juiste rollen aan de gebruikers
        $admin->roles()->attach($adminRole); // Koppel de admin rol
        $student->roles()->attach($studentRole); // Koppel de student rol
    }
}