<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePujosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pujos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('asistente_id');
            $table->foreign('asistente_id')->references('id')->on('asistentes');
            $table->unsignedBigInteger('item_id');
            $table->foreign('item_id')->references('id')->on('items_catalogos');
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
        Schema::dropIfExists('pujos');
    }
}
