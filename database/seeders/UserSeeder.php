<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Users   = [
            [
                'name' => 'Karisma Putra Purwanto',
                'email' => 'kharizma.putra@gmail.com',
                'password' => bcrypt('123456'),
                'email_verified_at' => '2023-01-06 13:45:10',
                'no_hp' => '082237540250',
                'role' => '1',
                'status' => '1'
            ],
            [
                'name' => 'Lamtaruli Sitohang',
                'email' => 'quensya.uli@gmail.com',
                'password' => bcrypt('123456'),
                'email_verified_at' => '2023-01-06 13:45:10',
                'no_hp' => '082237540250',
                'role' => '1',
                'status' => '1'
            ]
        ];

        User::truncate();
        foreach ($Users as $key => $user) {
            User::create($user);
        }
    }
}
