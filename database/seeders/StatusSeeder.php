<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Statuses   = [
            ['status_name' => 'Aktif', 'status_key' => '1', 'status_val' => 'aktif'],
            ['status_name' => 'Tidak Aktif', 'status_key' => '2', 'status_val' => 'aktif'],
            ['status_name' => 'Menikah', 'status_key' => '1', 'status_val' => 'pernikahan'],
            ['status_name' => 'Belum Menikah', 'status_key' => '2', 'status_val' => 'pernikahan'],
        ];

        Status::truncate();
        foreach ($Statuses as $key => $status) {
            Status::create($status);
        }
    }
}
