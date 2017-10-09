<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColsDenunciasSS extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

      Schema::table('delitos_atribuidos', function($table) {
          $table->dropColumn(['imputado_id']);
      });

      Schema::table('delitos_atribuidos', function($table) {
          $table->integer('imputado_id')->nullable();
      });

      Schema::table('denuncias_mp', function($table) {
        $table->string('numero_denuncia')->nullable();
      });

      Schema::table('denuncias_ss', function($table) {
        $table->string('numero_denuncia');
        $table->integer('formable_id');
        $table->string('formable_type');
      });

      Schema::create('denuncias_fuentes_formales', function($table) {
        $table->increments('id');
        $table->integer('depedencia_id'); //unidad competente
        $table->boolean('deleted')->default(false);
        $table->timestamps();
      });

      Schema::create('denuncias_fuentes_no_formales', function($table) {
        $table->increments('id');
        $table->json('fuente_informacion')->nullable();  //llamada telefónica, medio comunicación, otro
        $table->boolean('deleted')->default(false);
        $table->timestamps();
      });

      Schema::create('sospechosos', function($table) {
        $table->increments('id');
        $table->integer('denuncia_id');
        $table->boolean('deleted')->default(false);
        $table->timestamps();
      });

      Schema::table('lugares', function($table) {
        $table->string('caracteristicas')->nullable();
      });

      Schema::table('personas_naturales_ss', function($table) {
        $table->string('residente')->nullable(); //donde reside la persona
      });

      Schema::create('anexos', function($table) {
        $table->increments('id');
        $table->integer('denuncia_id');
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
        //
    }
}
