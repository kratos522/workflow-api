<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDomiciliosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('domicilios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('persona_id');
            $table->integer('departamento_id')->nullable();
            $table->integer('municipio_id')->nullable();
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
        Schema::dropIfExists('domicilios');
    }
}
