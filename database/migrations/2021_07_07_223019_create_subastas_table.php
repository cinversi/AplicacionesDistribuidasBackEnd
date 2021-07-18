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
                ])->nullable()->default('cerrada');;
            $table->integer('capacidadAsistentes');
            $table->enum('tieneDeposito', [
                'si',
                'no'
                ])->nullable()->default('no');;
            $table->enum('seguridadPropia', [
                'si',
                'no'
                ])->nullable()->default('no');;
            $table->enum('categoria', [
                'COMUN', 
                'ESPECIAL', 
                'PLATA', 
                'ORO', 
                'PLATINO'
                ]);
            $table->string('moneda')->nullable()->default('ARS');
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
