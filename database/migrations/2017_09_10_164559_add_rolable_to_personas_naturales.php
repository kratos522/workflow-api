<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRolableToPersonasNaturales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('personas_naturales', function($table) {
          $table->string('rolable_type')->nullable();
          $table->integer('rolable_id')->nullable();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('personas_naturales', function($table) {
        $table->dropColumn('rolable_type');
        $table->dropColumn('rolable_id');
      });
    }
}
