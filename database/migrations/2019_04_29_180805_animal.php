<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Animal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animal', function (Blueprint $table) {
            $table->bigIncrements('id_animal');
            $table->string('nome', 100);
            $table->longText('historico', 100);
            $table->date('data_nascimento');
            $table->string('nome_usuario', 100);
            $table->foreign('nome_usuario')->references('nome_usuario')->on('usuario');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
