<?php

use Illuminate\Database\Seeder;

class KecamatansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kecamatans')->insert([
            [
                'nama_kecamatan' => 'Tanjung Redeb'
            ],
            [
                'nama_kecamatan' => 'Teluk Bayur'
            ],
            [
                'nama_kecamatan' => 'Gunung Tabur'
            ],
            [
                'nama_kecamatan' => 'Sambaliung'
            ],
            [
                'nama_kecamatan' => 'Kelay'
            ],
            [
                'nama_kecamatan' => 'Segah'
            ],
            [
                'nama_kecamatan' => 'Talisayan'
            ],
            [
                'nama_kecamatan' => 'Tabalar'
            ],
            [
                'nama_kecamatan' => 'Biatan'
            ],
            [
                'nama_kecamatan' => 'Batu Putih'
            ],
            [
                'nama_kecamatan' => 'Biduk-Biduk'
            ],
            [
                'nama_kecamatan' => 'Pulau Derawan'
            ],
            [
                'nama_kecamatan' => 'Maratua'
            ]
        ]);
    }
}
