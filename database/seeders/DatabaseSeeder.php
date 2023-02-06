<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            SistemInfoSeeder::class,
            AdminSeeder::class,
            AdminRolesPermissionSeeder::class,
            UserSeeder::class,
            UserRolesPermissionsSeeder::class,
            MenuSeeder::class,
            StatusSeeder::class
        ]);
    }
}
