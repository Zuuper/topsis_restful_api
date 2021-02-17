<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbTransaksi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_transaksi', function (Blueprint $table) {
            $table->increments('id_transaksi');
            $table->integer('id_nasabah')->unsigned();
            $table->foreign('id_nasabah')->references('id_nasabah')->on('tb_nasabah')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('id_warung')->unsigned();
            $table->foreign('id_warung')->references('id_warung')->on('tb_warung')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('tb_transaksi');
    }
}
