<?php

use Illuminate\Database\Seeder;

class KaryawansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('karyawans')->insert([
            [
                'kode_karyawan' => 'KAR1',
                'nama_karyawan' => 'Hadi',
                'telepon' => '089454545455',
                'alamat' => 'Jl. Bali',
                'id_kecamatan' => 1,
                'id_kelurahan' => 3
            ],
            [
                'kode_karyawan' => 'ADM1',
                'name' => 'Bayu',
                'telepon' => '08945422255',
                'alamat' => 'Jl. Bangka',
                'id_kecamatan' => 1,
                'id_kelurahan' => 3
            ],
        ]);
    }
}
