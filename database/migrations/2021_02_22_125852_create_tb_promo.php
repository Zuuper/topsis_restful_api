<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbPromo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_promo', function (Blueprint $table) {
            $table->increments('id_promo');
            $table->integer('id_warung')->unsigned();
            $table->foreign('id_warung')->references('id_warung')->on('tb_warung')->onDelete('restrict')->onUpdate('cascade');
            $table->date('tanggal_mulai');
            $table->date('tanggal_berakhir');
            $table->text('keterangan');
            $table->string('gambar_promo');
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
        Schema::dropIfExists('tb_promo');
    }
}
