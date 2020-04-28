<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordem_usuarios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('loja_id');

            $table->string('referencia');
            $table->string('pagseguro_code');
            $table->integer('pagseguro_status');

            $table->longText('items');

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('loja_id')->references('id')->on('lojas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_order');
    }
}
