<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUbicacionesMP extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::dropIfExists('aldeas');
      Schema::create('aldeas_mp', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('municipio_id');
          $table->string('nombre');
          $table->boolean('deleted')->default(false);
          $table->timestamps();
      });

      Schema::dropIfExists('barrios');
      Schema::create('barrios_mp', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('aldea_mp_id');
          $table->string('nombre');
          $table->boolean('deleted')->default(false);
          $table->timestamps();
      });

      Schema::dropIfExists('caserios');
      Schema::create('caserios_mp', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('barrio_mp_id');
          $table->string('nombre');
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
        Schema::dropIfExists('caserios_mp');
        Schema::dropIfExists('barrios_mp');
        Schema::dropIfExists('aldeas_mp');
    }
}
