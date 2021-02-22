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
            $table->date('tanggal_mulai');
            $table->date('tanggal_berakhir');
            $table->text('keterangan');
        });
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
