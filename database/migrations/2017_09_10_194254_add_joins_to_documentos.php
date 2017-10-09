<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddJoinsToDocumentos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('documentos', function($table) {
          $table->integer('institucion_id');
          $table->integer('dependencia_id');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('documentos', function($table) {
          $table->integer('institucion_id');
          $table->integer('dependencia_id');
      });
    }
}
