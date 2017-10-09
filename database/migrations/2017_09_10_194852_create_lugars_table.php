<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLugarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('lugares');
        Schema::create('lugares', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('documento_id');
            $table->integer('departamento_id');
            $table->integer('municipio_id');
            $table->integer('barrio_id')->nullable();
            $table->integer('aldea_id')->nullable();
            $table->integer('caserio_id')->nullable();
            $table->text('descripcion');
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
        Schema::dropIfExists('lugares');
    }
}
