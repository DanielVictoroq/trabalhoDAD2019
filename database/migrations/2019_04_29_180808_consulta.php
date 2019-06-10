<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Consulta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consulta', function (Blueprint $table) {
            $table->bigIncrements('id_consulta');
            $table->string('status', 100);
            $table->longText('observacoes')->nullable();
            $table->date('data_hora');
            $table->string('admin', 100);
            $table->string('cliente', 100);
            $table->bigInteger('id_animal')->unsigned();
            $table->foreign('admin')->references('nome_usuario')->on('admin')->nullable();
            $table->foreign('cliente')->references('nome_usuario')->on('usuario');
            $table->foreign('id_animal')->references('id_animal')->on('animal');
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
