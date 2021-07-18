<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('fecha');
            $table->enum('disponible', [
                'si',
                'no',
                'aprobado',
                'rechazado',
                'subastado'
                ])->nullable()->default('no');
            $table->string('descripcionCatalogo')->nullable()->default('No Posee');
            $table->string('descripcionCompleta')->nullable();
            $table->string('cantidad')->nullable();
            $table->string('artista_obra')->nullable();
            $table->string('fecha_obra')->nullable();
            $table->string('historia_obra')->nullable();
            $table->unsignedBigInteger('revisor_id');
            $table->foreign('revisor_id')->references('id')->on('empleados');
            $table->unsignedBigInteger('duenio_id');
            $table->foreign('duenio_id')->references('id')->on('duenios');
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
        Schema::dropIfExists('productos');
    }
}
