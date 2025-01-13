<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    public function run(): void
    {
        Role::truncate();

        Role::Create(['name' => 'manager']);

        Role::Create(['name' => 'medewerker']);

        Role::Create(['name' => 'klant']);
    }
}