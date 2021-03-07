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
            $table->foreign('id_warung')->references('id_warung')->on('tb_warung')->onDelete('restrict')->onUpdate('cascade');
            $table->string('nama_produk', 60);
            $table->string('keterangan_produk', 199);
            $table->integer('harga_produk');
            $table->integer('stok_produk');
            $table->string('gambar_produk');
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
        Schema::dropIfExists('tb_produk');
    }
}
