<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRolableToPersonasNaturalesSs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('personas_naturales_ss', function($table) {
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
      Schema::table('personas_naturales_ss', function($table) {
          $table->string('rolable_type')->nullable();
          $table->integer('rolable_id')->nullable();
      });
    }
}
