<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNumerosExpedientesToExpedientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('expedientes', function($table) {
          $table->string('numero_expediente');
      });

      Schema::table('expedientes_mp', function($table) {
          $table->string('numero_expediente');
      });

      Schema::table('expedientes_ss', function($table) {
          $table->string('numero_expediente');
      });

      Schema::table('expedientes_pj', function($table) {
          $table->string('numero_expediente');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('expedientes', function($table) {
          $table->string('numero_expediente');
      });

      Schema::table('expedientes_mp', function($table) {
          $table->string('numero_expediente');
      });

      Schema::table('expedientes_ss', function($table) {
          $table->string('numero_expediente');
      });

      Schema::table('expedientes_pj', function($table) {
          $table->string('numero_expediente');
      });         
    }
}
