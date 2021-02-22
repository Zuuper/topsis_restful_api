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
            $table->integer('id_warung')->unsigned();
            $table->dateTime('tgl_transaksi');
        });
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
