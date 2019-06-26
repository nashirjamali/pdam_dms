<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatatMetersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catat_meters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_meter')->index();
            $table->foreign('no_meter')->references('no_meter')->on('pelanggans')->onDelete('cascade');
            $table->string('nama');
            $table->integer('angka_meter');
            $table->string('gambar');
            $table->date('tanggal');
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
        Schema::dropIfExists('catat_meters');
    }
}
