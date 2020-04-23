<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLojaOrdem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loja_ordem', function (Blueprint $table) {
            $table->unsignedBigInteger('loja_id');
            $table->unsignedBigInteger('ordem_id');

            $table->foreign('loja_id')->references('id')->on('lojas');
            $table->foreign('ordem_id')->references('id')->on('ordem_usuarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loja_ordem');
    }
}
