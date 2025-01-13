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
        User::truncate();
        DB::table('role_user')->truncate();

        $managerRole = Role::where('name', 'manager')->first();
        $medewerkerRole = Role::where('name', 'medewerker')->first();
        $klantRole = Role::where('name', 'klant')->first();

        $manager = User::create([
            'name' => 'Manager',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678')
        ]);

        $medewerker = User::create([
            'name' => 'Medewerker',
            'email' => 'medewerker@gmail.com',
            'password' => Hash::make('12345678')
        ]);

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
            $user->roles()->attach($klantRole);
        }

        $manager->roles()->attach($managerRole);
        $medewerker->roles()->attach($medewerkerRole);
    }
}