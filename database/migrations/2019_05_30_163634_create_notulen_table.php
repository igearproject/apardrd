<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotulenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notulen', function (Blueprint $table) {
            $table->bigIncrements('id_notulen');
            $table->string('pimpinan',50);
            $table->string('pembuat',50);
            $table->text('kesimpulan');
            $table->string('file_notulen',100);
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
        Schema::dropIfExists('notulen');
    }
}
