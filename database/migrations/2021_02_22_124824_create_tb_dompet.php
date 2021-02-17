<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbDompet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_dompet', function (Blueprint $table) {
            $table->increments('id_dompet');
            $table->integer('id_nasabah')->unsigned();
            $table->foreign('id_nasabah')->references('id_nasabah')->on('tb_nasabah')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('saldo');
            
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
        Schema::dropIfExists('tb_dompet');
    }
}
