<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbFintech extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_fintech', function (Blueprint $table) {
            $table->increments('id_fintech');
            $table->string('nama', 30);
            $table->string('alamat', 100);
            $table->string('no_telpon', 20);
            $table->enum('status',['aktif','non aktif']);
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
        Schema::dropIfExists('tb_fintech');
    }
}
