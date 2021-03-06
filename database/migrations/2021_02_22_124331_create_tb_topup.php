<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbTopup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_topup', function (Blueprint $table) {
            $table->increments('id_topup');
            $table->integer('id_nasabah')->unsigned();
            $table->foreign('id_nasabah')->references('id_nasabah')->on('tb_nasabah')->onDelete('restrict')->onUpdate('cascade');            
            $table->dateTime('tgl_transaksi');
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_topup');
    }
}
