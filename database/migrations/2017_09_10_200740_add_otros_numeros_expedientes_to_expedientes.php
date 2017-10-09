<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOtrosNumerosExpedientesToExpedientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('expedientes_mp', function($table) {
          $table->string('numero_expediente_judicial')->nullable();
          $table->string('numero_expediente_policial')->nullable();
          $table->string('numero_expediente_sedi')->nullable();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('expedientes_mp', function($table) {
          $table->string('numero_expediente_judicial')->nullable();
          $table->string('numero_expediente_policial')->nullable();
          $table->string('numero_expediente_sedi')->nullable();
      });
    }
}
