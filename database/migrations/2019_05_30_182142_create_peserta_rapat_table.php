<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePesertaRapatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peserta_rapat', function (Blueprint $table) {
            $table->bigIncrements('id_peserta');
            $table->unsignedBigInteger('id_pegawai');
            $table->unsignedBigInteger('id_rapat');
            $table->enum('status',['hadir','sakit','izin','alpa','dinas_luar']);
            $table->text('keterangan')->nullable();
            $table->timestamp('dilihat_pada')->nullable();
            $table->timestamps();
            $table->foreign('id_rapat')->references('id_rapat')->on('rapat');
            $table->foreign('id_pegawai')->references('id_pegawai')->on('pegawai');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peserta_rapat');
    }
}
