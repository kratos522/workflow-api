<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCols2LugarSS extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('lugares_ss', function($table) {
        $table->integer('persona_natural_ss_id')->nullable();
        $table->integer('regional_id');
        $table->integer('departamento_id');
        $table->integer('municipio_id');
        $table->integer('ciudad_ss_id')->nullable;
        $table->integer('barrio_ss_id')->nullable;
        $table->integer('colonia_ss_id')->nullable;
        $table->integer('aldea_ss_id')->nullable;
        $table->integer('sector_ss_id')->nullable;                                                                   
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
