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
            $table->integer('jumlah_transaksi');
            $table->integer('catatan');
            
        });
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
