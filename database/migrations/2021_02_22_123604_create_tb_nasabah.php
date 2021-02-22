<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbNasabah extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_nasabah', function (Blueprint $table) {
            $table->increments('id_nasabah');
            $table->integer('id_fintech')->unsigned();
            $table->integer('id_membership')->unsigned();
            $table->string('nama_nasabah', 45);
            $table->string('nik_nasabah', 15);
            $table->string('alamat', 100);
            $table->string('username_nasabah', 45);
            $table->string('password', 45);
            $table->string('pin_transaksi', 6);
            $table->string('no_rekening', 15);
            $table->string('no_telpon', 15);
            $table->enum('status', ['aktif', 'non-aktif']);
            $table->dateTime('tangal_aktif');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_nasabah');
    }
}
