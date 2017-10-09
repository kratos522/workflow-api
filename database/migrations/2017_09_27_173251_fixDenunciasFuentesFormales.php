<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixDenunciasFuentesFormales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('denuncias_fuentes_formales', function($table) {
        $table->dropColumn(['depedencia_id']);
      });

      Schema::table('denuncias_fuentes_formales', function($table) {
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
        //
    }
}
