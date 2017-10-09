<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixFuncionarioSS extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('funcionarios_ss', function($table) {
        $table->dropColumn(['departamento', 'unidad', 'seccion']);
      });

      Schema::table('funcionarios_ss', function($table) {
        $table->integer('departamento_ss_id')->nullable();
        $table->integer('unidad_ss_id')->nullable();
        $table->integer('seccion_ss_id')->nullable();                                                
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
