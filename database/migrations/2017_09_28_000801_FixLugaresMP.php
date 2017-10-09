<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixLugaresMP extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('lugares_mp', function($table) {
        $table->dropColumn(['barrio_id', 'aldea_id', 'caserio_id']);
      });

      Schema::table('lugares_mp', function($table) {
        $table->integer('barrio_mp_id')->nullable();
        $table->integer('aldea_mp_id')->nullable();
        $table->integer('caserio_mp_id')->nullable();                                                
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
