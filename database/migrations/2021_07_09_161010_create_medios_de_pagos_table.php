<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediosDePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medios_de_pagos', function (Blueprint $table) {
            $table->id();
            $table->enum('verificado', [
                'si',
                'no',
                'rechazado'
                ])->nullable()->default('no');
            $table->string('cuentabancaria');
            $table->string('numero');
            $table->string('expiracion');
            $table->string('cvc');
            $table->string('nombre');
            $table->string('codigoPostal');
            $table->string('tipo');
            $table->unsignedBigInteger('cliente_id')->nullable();
            $table->foreign('cliente_id')->references('id')->on('clientes');
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
        Schema::dropIfExists('medios_de_pagos');
    }
}
