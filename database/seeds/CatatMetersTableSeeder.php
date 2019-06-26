<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CatatMetersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('catat_meters')->insert([
            [
                'no_meter' => '5678987654',
                'nama' => 'Aulia Utami',
                'angka_meter' => 12,
                'gambar' => '5678987654_20062019.jpg',
                'tanggal' => '2019-06-20',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'no_meter' => '5678987654',
                'nama' => 'Aulia Utami',
                'angka_meter' => 20,
                'tanggal' => '2019-07-20',
                'gambar' => '5678987654_20072019.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'no_meter' => '4782634727',
                'nama' => 'Andre Rizki',
                'angka_meter' => 30,
                'gambar' => '4782634727_15062019.jpg',
                'tanggal' => '2019-06-15',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}
