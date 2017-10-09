<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MoveColsToPersonasNaturales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('personas_naturales_mp', function($table) {
          $table->dropColumn(['escolaridad', 'discapacidad', 'pueblo_indigena']);
          $table->dropColumn(['ocupacion']);
        });

        Schema::table('personas', function($table) {
          $table->dropColumn(['numero_documento_identidad']);
        });

        Schema::table('personas_naturales', function($table) {
          $table->dropColumn(['discapacidad_id']);
        });

        Schema::table('personas_naturales', function($table) {
          $table->string('numero_documento_identidad')->nullable();
          $table->json('escolaridad')->nullable();
          $table->json('discapacidades')->nullable();
          $table->json('pueblo_indigena')->nullable();
        });

        Schema::dropIfExists('movils');
        Schema::create('moviles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descripcion');
            $table->json('tags')->nullable();
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
