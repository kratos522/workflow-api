<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixRoles3 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('roles', function($table) {
        $table->dropColumn(['dependencia_id']);
      });

      Schema::table('roles', function($table) {
        $table->integer('institucion_id');
        $table->integer('persona_natural_id');                                                               
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
