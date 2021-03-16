<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbTransferKeRekening extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_transfer_ke_rekening', function (Blueprint $table) {
            $table->increments('id_transfer_ke_rekening');
            $table->integer('id_warung')->unsigned();
            $table->foreign('id_warung')->references('id_warung')->on('tb_warung')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('tb_transfer_ke_rekening');
    }
}
