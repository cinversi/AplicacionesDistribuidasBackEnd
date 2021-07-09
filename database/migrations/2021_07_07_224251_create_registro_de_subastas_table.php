<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistroDeSubastasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registro_de_subastas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('importe');
            $table->float('comision');
            $table->unsignedBigInteger('subasta_id');
            $table->foreign('subasta_id')->references('id')->on('subastas');
            $table->unsignedBigInteger('duenio_id');
            $table->foreign('duenio_id')->references('id')->on('duenios');
            $table->unsignedBigInteger('producto_id');
            $table->foreign('producto_id')->references('id')->on('productos');
            $table->unsignedBigInteger('cliente_id');
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
        Schema::dropIfExists('registro_de_subastas');
    }
}
