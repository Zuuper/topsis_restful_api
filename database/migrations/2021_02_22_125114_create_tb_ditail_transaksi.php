<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbDitailTransaksi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_ditail_transaksi', function (Blueprint $table) {
            $table->increments('id_ditail_transaksi');
            $table->integer('id_transaksi')->unsigned();
            $table->foreign('id_transaksi')->references('id_transaksi')->on('tb_transaksi')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('jumlah_transaksi');
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
        Schema::dropIfExists('tb_ditail_transaksi');
    }
}
