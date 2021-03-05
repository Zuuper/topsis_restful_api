<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbDitailTopup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_ditail_topup', function (Blueprint $table) {
            $table->increments('id_ditail_topup');
            $table->integer('id_topup')->unsigned();
            $table->foreign('id_topup')->references('id_topup')->on('tb_topup')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('id_dompet')->unsigned();
            $table->foreign('id_dompet')->references('id_dompet')->on('tb_dompet')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('jumlah_transaksi');
            $table->string('no_rekening', 15);
            
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
        Schema::dropIfExists('tb_ditail_topup');
    }
}