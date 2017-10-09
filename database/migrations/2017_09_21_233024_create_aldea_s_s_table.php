<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAldeaSSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('aldeas_ss');
        Schema::create('aldeas_ss', function (Blueprint $table) {
            $table->increments('id');
            $table->string('aldea');
            $table->integer('sector_ss_id');
            $table->integer('colonia_ss_id')->nullable();
            $table->boolean('deleted')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aldeas_ss');
    }
}
