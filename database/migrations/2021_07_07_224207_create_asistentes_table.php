<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsistentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asistentes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('numeroPostor');
            $table->string('participando')->nullable()->default(0);
            $table->unsignedBigInteger('cliente_id');
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->unsignedBigInteger('subasta_id');
            $table->foreign('subasta_id')->references('id')->on('subastas');
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
        Schema::dropIfExists('asistentes');
    }
}
