<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixInstitucionableNotNull extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('expedientes', function($table) {
        $table->dropColumn(['institucionable_type', 'institucionable_id']);
      });

      Schema::table('expedientes', function($table) {
        $table->integer('institucionable_id');
        $table->string('institucionable_type');                                          
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
