<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $Admins   = [
            [

                'name' => 'Admin',
                'email' => 'admin@bitstart.test',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'no_hp' => '082237540250',
                'role' => '1',
                'status' => '1'
                
                
            ],
            [

                'name' => 'Operator',
                'email' => 'operator@bitstart.test',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'no_hp' => '082237540250',
                'role' => '1',
                'status' => '1'
                
            ],
        ];

        Admin::truncate();
        foreach ($Admins as $key => $admin) {
            Admin::create($admin);
        }
    }
}
