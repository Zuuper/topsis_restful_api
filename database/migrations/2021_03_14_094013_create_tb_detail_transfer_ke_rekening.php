<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbDetailTransferKeRekening extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_detail_transfer_ke_rekening', function (Blueprint $table) {
            $table->increments('id_detail_transfer_ke_rekening');
            $table->integer('id_fintech')->unsigned();
            $table->foreign('id_fintech')->references('id_fintech')->on('tb_fintech')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('id_transfer_ke_rekening')->unsigned();
            $table->foreign('id_transfer_ke_rekening')->references('id_transfer_ke_rekening')->on('tb_transfer_ke_rekening')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('id_dompet')->unsigned();
            $table->foreign('id_dompet')->references('id_dompet')->on('tb_dompet')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('jumlah_transaksi');
            $table->string('no_rekening');
            $table->enum('status',['pending','sukses','gagal']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_detail_transfer_ke_rekening');
    }
}
