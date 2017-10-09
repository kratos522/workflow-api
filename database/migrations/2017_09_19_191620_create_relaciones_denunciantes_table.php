<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelacionesDenunciantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

      Schema::create('parentescos', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('descripcion');
          $table->boolean('deleted')->default(false);
          $table->timestamps();
      });

      Schema::create('relaciones_imputados', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('imputado_id');
          $table->integer('parentesco_id');
          $table->integer('relacionable_id');
          $table->string('relacionable_type');
          $table->boolean('deleted')->default(false);
          $table->timestamps();
      });

      Schema::create('relaciones_imputados_denunciantes', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('denunciante_id');
          $table->boolean('deleted')->default(false);
          $table->timestamps();
      });

      Schema::create('relaciones_imputados_ofendidos', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('ofendido_id');
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
        Schema::dropIfExists('parentescos');
        Schema::dropIfExists('relaciones_imputados');
        Schema::dropIfExists('relaciones_imputados_denunciantes');
        Schema::dropIfExists('relaciones_imputados_ofendidos');
    }
}
