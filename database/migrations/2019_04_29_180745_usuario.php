<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Usuario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('usuario', function (Blueprint $table) {
            $table->string('nome_usuario', 100);
            $table->primary('nome_usuario');
            $table->string('nome', 100);
            $table->string('sobrenome', 100);
            $table->integer('cpf');
            $table->date('data_nascimento');
            $table->string('email', 100);
            $table->string('senha', 100);
            $table->integer('qtdanimais');
            $table->integer('id_endereco');
            $table->foreign('id_endereco')->references('id_endereco')->on('endereco');
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
