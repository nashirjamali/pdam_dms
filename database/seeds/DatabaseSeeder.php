<?php

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
        $this->call(KecamatansTableSeeder::class);
        $this->call(KelurahansTableSeeder::class);
        $this->call(KaryawansTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(PelanggansTableSeeder::class);
        $this->call(CatatMetersTableSeeder::class);
    }
}
