<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDelitoSexualySuicidiotoDelitoImputado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

      Schema::table('ofendidos', function($table) {
        $table->integer('tipoable_id')->nullable();
        $table->string('tipoable_type')->nullable();                                                              
      });

      Schema::create('delitos_sexuales', function (Blueprint $table) {
          $table->increments('id');
          $table->string('victima_embarazada');
          $table->string('frecuencia');
          $table->string('trabajo_remunerado');
          $table->string('asiste_centro_vocacional');
          $table->integer('cantidad_hijos');
          $table->boolean('deleted')->default(false);
          $table->timestamps();
      });
      Schema::create('suicidios', function (Blueprint $table) {
          $table->increments('id');
          $table->string('intentos_previos');
          $table->string('antecedentes_enfermedad_mental');
          $table->json('mecanismo_de_muerte');
          $table->boolean('deleted')->default(false);
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
        Schema::dropIfExists('delitos_sexuales');
        Schema::dropIfExists('suicidios');
    }
}
