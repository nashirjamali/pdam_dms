<?php

use Illuminate\Database\Seeder;

class PelanggansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pelanggans')->insert([
            [
                'no_meter' => '5678987654',
                'nama' => 'Aulia Utami',
                'alamat' => 'Jalan Gayam Selatan No. 20',
                'id_kecamatan' => 1,
                'id_kelurahan' => 3
            ],
            [
                'no_meter' => '4782634727',
                'nama' => 'Andre Rizki',
                'alamat' => 'Jalan Gayam Utara No. 41',
                'id_kecamatan' => 1,
                'id_kelurahan' => 3
            ]
        ]);
    }
}
