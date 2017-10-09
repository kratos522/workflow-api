<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixPersonasMenores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('personas_menores', function($table) {
        $table->dropColumn(['persona_id']);
      });

      Schema::table('personas_menores', function($table) {
        $table->integer('persona_natural_id');
        $table->string('representante_legal_id')->nullable();           
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
