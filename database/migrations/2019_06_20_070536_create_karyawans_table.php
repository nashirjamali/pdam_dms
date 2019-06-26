<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKaryawansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('karyawans', function (Blueprint $table) {
            $table->string('kode_karyawan')->index();
            $table->primary('kode_karyawan');
            $table->string('nama_karyawan');
            $table->bigInteger('id_kecamatan')->nullable()->unsigned();
            $table->foreign('id_kecamatan')->references('id_kecamatan')->on('kecamatans')->onDelete('cascade');
            $table->bigInteger('id_kelurahan')->unsigned()->unsigned();
            $table->foreign('id_kelurahan')->references('id_kelurahan')->on('kelurahans')->onDelete('cascade');
            $table->string('alamat');
            $table->string('telepon');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('karyawans');
    }
}
