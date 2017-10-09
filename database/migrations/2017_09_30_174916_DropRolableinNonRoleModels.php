<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropRolableinNonRoleModels extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('personas_naturales', function($table) {
        $table->dropColumn(['rolable_type', 'rolable_id']);
      });

      Schema::table('personas_naturales_mp', function($table) {
        $table->dropColumn(['rolable_type', 'rolable_id']);
      });

      Schema::table('personas_naturales_ss', function($table) {
        $table->dropColumn(['rolable_type', 'rolable_id']);
      });
      Schema::table('personas_naturales_pj', function($table) {
        $table->dropColumn(['rolable_type', 'rolable_id']);
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
