<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDueniosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('duenios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('numeroPais')->nullable()->default('ARG');;
            $table->enum('verificaciónFinanciera', [
                'si',
                'no'
                ])->nullable()->default('si');
            $table->enum('verificaciónJudicial', [
                'si',
                'no'
                ])->nullable()->default('si');
            $table->enum('calificacionRiesgo', [
                1,2,3,4,5,6
                ])->nullable()->default('1');
            $table->unsignedBigInteger('persona_id');
            $table->foreign('persona_id')->references('id')->on('personas');
            $table->unsignedBigInteger('verificador');
            $table->foreign('verificador')->references('id')->on('empleados');
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
        Schema::dropIfExists('duenios');
    }
}
