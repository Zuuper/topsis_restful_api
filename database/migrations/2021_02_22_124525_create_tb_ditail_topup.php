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
            $table->integer('id_dompet')->unsigned();
            $table->integer('jumlah_transaksi');
            $table->string('no_rekening', 15);
            
        });
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
