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
            $table->foreign('id_fintech')->references('id_fintech')->on('tb_fintech')->onDelete('cascade');
            $table->integer('id_membership')->unsigned();
            $table->foreign('id_membership')->references('id_membership')->on('tb_membership')->onDelete('cascade');
            $table->string('nama_nasabah', 45);
            $table->string('nik_nasabah', 15);
            $table->string('alamat', 100);
            $table->string('username_nasabah', 45)->unique();
            $table->string('password', 45);
            $table->string('pin_transaksi', 6);
            $table->string('no_rekening', 15);
            $table->string('no_telpon', 15);
            $table->enum('status', ['aktif', 'non-aktif']);
            $table->dateTime('tangal_aktif');

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
        Schema::drop('tb_nasabah');
    }
}
