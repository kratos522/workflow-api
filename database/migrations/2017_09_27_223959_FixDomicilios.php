<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixDomicilios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('domicilios', function($table) {
        $table->dropColumn(['barrio_id', 'caserio_id', 'aldea_id']);
      });

      Schema::table('domicilios', function($table) {
        $table->integer('barrio_mp_id');
        $table->integer('caserio_mp_id');
        $table->integer('aldea_mp_id');                                               
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
