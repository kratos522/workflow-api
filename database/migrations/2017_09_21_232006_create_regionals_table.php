<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegionalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('regionales');
        Schema::create('regionales', function (Blueprint $table) {
            $table->increments('id');
            $table->string('regional');
            $table->boolean('deleted')->default(false);
            $table->timestamps();
        });

        Schema::table('departamentos', function($table) {
          $table->integer('regional_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('regionales');
    }
}
