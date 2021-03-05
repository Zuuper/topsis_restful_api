<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbWarung extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    
        Schema::create('tb_warung', function (Blueprint $table) {
            $table->increments('id_warung');
            $table->integer('id_fintech')->unsigned();
            $table->foreign('id_fintech')->references('id_fintech')->on('tb_fintech')->onDelete('restrict')->onUpdate('cascade');
            $table->string('nama_pemilik', 30);
            $table->string('nik_pemilik', 16);
            $table->string('alamat', 45);
            $table->string('nama_warung', 20)->unique();
            $table->string('username_warung', 20)->unique();
            $table->string('password');
            $table->string('no_rekening', 15);
            $table->string('no_telpon', 15);
            $table->enum('status', ['aktif', 'non-aktif']);
            $table->dateTime('tanggal_aktif');
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
        Schema::dropIfExists('tb_warung');
    }
}
