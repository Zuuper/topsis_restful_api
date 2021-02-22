<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbProduk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_produk', function (Blueprint $table) {
            $table->increments('id_produk');
            $table->integer('id_warung')->unsigned();
            $table->string('nama_produk', 60);
            $table->integer('harga');
            $table->integer('stok');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_produk');
    }
}
