<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePegawaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawai', function (Blueprint $table) {
            $table->bigIncrements('id_pegawai');
            $table->string('nama',50);
            $table->string('nip',20);
            $table->string('jabatan',30);
            $table->enum('jenis_kelamin',['L','P']);
            $table->string('no_hp',15);
            $table->string('email',100);
            $table->enum('agama',['hindu','islam','kristen protestan','katolik','buddha','kong hu cu']);
            $table->date('tanggal_lahir');
            $table->string('foto',100);
            $table->text('alamat');
            $table->enum('status_pegawai',['aktif','tidak_aktif','pensiun']);
            $table->unsignedBigInteger('id_opd');
            $table->timestamps();
            $table->foreign('id_opd')->references('id_opd')->on('opd');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('anggota');
    }
}
