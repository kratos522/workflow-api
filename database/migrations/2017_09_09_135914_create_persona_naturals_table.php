<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonaNaturalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('personas_naturales');
        Schema::create('personas_naturales', function (Blueprint $table) {
            $table->increments('id');
            $table->string('genero')->nullable(); // Masculino, Femenino
            $table->string('sexo')->nullable();  // Hombre, Mujer
            $table->string('nacionalidad')->nullable();
            $table->json('tipo_documento_identidad')->nullable();  //pasaporte, tarjeta identidad, etc
            $table->string('nombres')->nullable();
            $table->string('primer_apellido')->nullable();
            $table->string('segundo_apellido')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->integer('edad')->nullable();
            $table->string('estado_civil')->nullable();
            $table->integer('institucionable_id')->nullable();
            $table->string('institucionable_type')->nullable();
            $table->integer('profesionable_id')->nullable();
            $table->string('profesionable_type')->nullable();
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
        Schema::dropIfExists('personas_naturales');
    }
}
