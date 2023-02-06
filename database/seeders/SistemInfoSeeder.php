<?php

namespace Database\Seeders;

use App\Models\SistemInfo;
use Illuminate\Database\Seeder;

class SistemInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $SistemInfos   = [
            [
                'nama' => 'PETC - POLDA KALTENG',
                'badan' => 'PT. Betang Inti Teknologi',
                'alamat' => 'Jl. G. Obos VII Gg. Rabakoi Jaya. Perum Bhakti Praja Blok B No. 24',
                'kelurahan_desa' => 'Menteng',
                'kecamatan' => 'Jekan Raya',
                'kabupaten_kota' => 'Kota Palangka Raya',
                'provinsi' => 'Kalimantan Tengah',
                'kodepos' => '73112',
                'hp' => '082237540250',
                'email' => 'betang.inti.teknologi@gmail.com',
                'logo' => 'logo.png'
            ]
        ];

        SistemInfo::truncate();
        foreach ($SistemInfos as $key => $sistemInfo) {
            SistemInfo::create($sistemInfo);
        }
    }
}
