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

        $adminRole = Role::where('name', 'admin')->first();
        $studentRole = Role::where('name', 'student')->first();

        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
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
            $user->roles()->attach($studentRole);
        }

        $admin->roles()->attach($adminRole);
    }
}