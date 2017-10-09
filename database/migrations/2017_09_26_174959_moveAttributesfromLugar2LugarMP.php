<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MoveAttributesfromLugar2LugarMP extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('lugares', function($table) {
        $table->dropColumn(['departamento_id', 'municipio_id', 'barrio_id', 'aldea_id','caserio_id']);
      });

      Schema::table('lugares_mp', function($table) {
        $table->integer('departamento_id');
        $table->integer('municipio_id');
        $table->integer('barrio_id')->nullable();
        $table->integer('aldea_id')->nullable();
        $table->integer('caserio_id')->nullable();                                     
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
