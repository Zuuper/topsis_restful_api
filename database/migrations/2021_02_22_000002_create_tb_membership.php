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
            $table->foreign('id_fintech')->references('id_fintech')->on('tb_fintech')->onDelete('restrict')->onUpdate('cascade');
            $table->enum('kategori', ['gold', 'silver', 'bronze']);
            $table->integer('limit');
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
        Schema::dropIfExists('tb_membership');
    }
}
