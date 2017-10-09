<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixLugaresMPPersonaNAturalMP extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('lugares_mp', function($table) {
        $table->dropColumn(['persona_natural_id']);
      });

      Schema::table('lugares_mp', function($table) {
        $table->integer('persona_natural_mp_id')->nullable();
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
