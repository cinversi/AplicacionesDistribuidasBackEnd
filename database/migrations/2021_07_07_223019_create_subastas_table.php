<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubastasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subastas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ubicacion');
            $table->date('fecha');
            $table->time('horaInicio');
            $table->time('horaFin');
            $table->enum('estado', [
                'abierta',
                'cerrada'
                ]);
            $table->integer('capacidadAsistentes');
            $table->enum('tieneDeposito', [
                'si',
                'no'
                ]);
            $table->enum('seguridadPropia', [
                'si',
                'no'
                ]);
            $table->enum('categoria', [
                'comun', 
                'especial', 
                'plata', 
                'oro', 
                'platino'
                ]);
            $table->unsignedBigInteger('subastador_id')->nullable();
            $table->foreign('subastador_id')->references('id')->on('subastadores');
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
        Schema::dropIfExists('subastas');
    }
}
