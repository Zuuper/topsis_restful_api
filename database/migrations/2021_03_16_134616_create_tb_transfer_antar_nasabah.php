<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbTransferAntarNasabah extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_transfer_antar_nasabah', function (Blueprint $table) {
            $table->increments('id_transfer_antar_nasabah');
            $table->integer('id_nasabah_pengirim')->unsigned();
            $table->foreign('id_nasabah_pengirim')->references('id_nasabah')->on('tb_nasabah')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('id_nasabah_penerima')->unsigned();
            $table->foreign('id_nasabah_penerima')->references('id_nasabah')->on('tb_nasabah')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('jumlah_transfer');
            $table->string('catatan', 100);
            $table->timestamps();
            
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
        Schema::dropIfExists('tb_transfer_antar_nasabah');
    }
}
