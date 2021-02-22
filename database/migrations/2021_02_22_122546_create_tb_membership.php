<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbMembership extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_membership', function (Blueprint $table) {
            $table->increments('id_membership');
            $table->integer('id_fintech')->unsigned();
            $table->enum('kategori', ['gold', 'silver', 'bronze']);
            $table->integer('limit');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_membership');
    }
}
