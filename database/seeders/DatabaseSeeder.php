<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder; // Zorg ervoor dat dit wordt geïmporteerd
use Database\Seeders\RolesTableSeeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Seed de rollen
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        // Andere seeders kunnen hier ook worden aangeroepen
    }
}
