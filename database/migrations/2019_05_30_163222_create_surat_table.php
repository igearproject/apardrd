<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuratTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat', function (Blueprint $table) {
            $table->bigIncrements('id_surat');
            $table->string('no_surat',100);
            $table->date('tanggal_pembuatan');
            $table->string('tempat_pembuatan',30);
            $table->string('perihal',50);
            $table->string('file',100)->nullable();
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
        Schema::dropIfExists('surat');
    }
}
