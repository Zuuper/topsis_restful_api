<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbTransfer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_transfer', function (Blueprint $table) {
            $table->increments('id_transfer');
            $table->integer('id_nasabah')->unsigned();
            $table->foreign('id_nasabah')->references('id_nasabah')->on('tb_nasabah')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('id_nasabah_penerima');
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
        Schema::dropIfExists('tb_transfer');
    }
}
