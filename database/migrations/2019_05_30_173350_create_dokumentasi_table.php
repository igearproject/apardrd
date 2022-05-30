<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDokumentasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dokumentasi', function (Blueprint $table) {
            $table->bigIncrements('id_dokumentasi');
            $table->string('nama',100);
            $table->unsignedBigInteger('id_rapat');
            $table->timestamps();
            $table->foreign('id_rapat')->references('id_rapat')->on('rapat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dokumentasi');
    }
}
