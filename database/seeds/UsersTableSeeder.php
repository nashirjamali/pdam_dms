<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'kode_karyawan' => 'KAR1',
                'role' => 'user',
                'password' => bcrypt('12345678')
            ],
            [
                'kode_karyawan' => 'ADM1',
                'role' => 'admin',
                'password' => bcrypt('12345678')
            ]
        ]);
    }
}
