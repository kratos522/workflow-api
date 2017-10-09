<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFechasToDenuncias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('denuncias', function($table) {
          $table->dateTime('fecha_denuncia');
      });

      Schema::table('denunciados', function($table) {
          $table->integer('denuncia_id');
      });

      Schema::table('denunciantes', function($table) {
          $table->integer('denuncia_id');
      });

      Schema::table('ofendidos', function($table) {
          $table->integer('denuncia_id');
      });

      Schema::table('imputados', function($table) {
          $table->integer('denuncia_id');
      });

      Schema::table('personas_naturales', function($table) {
          $table->integer('discapacidad_id')->nullable();
          $table->json('ocupaciones')->nullable();
          $table->json('profesiones')->nullable();
          $table->json('etnias')->nullable();
      });

      Schema::table('documentos', function($table) {
          $table->string('tipoable_type');
          $table->string('tipoable_id');
          $table->string('titulo')->nullable();
          $table->text('descripcion')->nullable();
          $table->float('tamano')->nullable();
          $table->json('tags')->nullable();
      });

      Schema::table('imputados', function($table) {
          $table->string('condicion')->nullable();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('denuncias', function($table) {
          $table->dateTime('fecha_denuncia');
      });

      Schema::table('denunciados', function($table) {
          $table->integer('denuncia_id');
      });

      Schema::table('denunciantes', function($table) {
          $table->integer('denuncia_id');
      });

      Schema::table('ofendidos', function($table) {
          $table->integer('denuncia_id');
      });

      Schema::table('imputados', function($table) {
          $table->integer('denuncia_id');
      });

      Schema::table('personas_naturales', function($table) {
          $table->integer('discapacidad_id')->nullable();
          $table->json('ocupaciones')->nullable();
          $table->json('profesiones')->nullable();
          $table->json('etnias')->nullable();
      });

      Schema::table('documentos', function($table) {
          $table->string('tipoable_type');
          $table->string('tipoable_id');
          $table->string('titulo')->nullable();
          $table->text('descripcion')->nullable();
          $table->float('tamano')->nullable();
          $table->json('tags')->nullable();
      });

      Schema::table('imputados', function($table) {
          $table->string('condicion')->nullable();
      });
    }
}
