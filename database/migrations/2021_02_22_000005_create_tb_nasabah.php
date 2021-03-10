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
            $table->foreign('id_fintech')->references('id_fintech')->on('tb_fintech')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('id_membership')->unsigned();
            $table->foreign('id_membership')->references('id_membership')->on('tb_membership')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('id_dompet')->unsigned();
            $table->foreign('id_dompet')->references('id_dompet')->on('tb_dompet')->onDelete('restrict')->onUpdate('cascade');
            $table->string('nama_nasabah', 20);
            $table->string('nik_nasabah', 16);
            $table->string('alamat_nasabah', 100);
            $table->string('username_nasabah', 15)->unique();
            $table->string('password_nasabah', 199);
            $table->string('pin_transaksi_nasabah', 199);
            $table->string('no_rekening_nasabah', 30)->unique();
            $table->string('no_telpon_nasabah', 15);
            $table->enum('status_nasabah', ['aktif', 'non aktif']);
            $table->dateTime('tanggal_aktif_nasabah');
            $table->rememberToken();
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
        Schema::drop('tb_nasabah');
    }
}
