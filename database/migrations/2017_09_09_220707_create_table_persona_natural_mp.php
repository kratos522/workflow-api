<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePersonaNaturalMp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('personas_naturales_mp');      
        Schema::create('personas_naturales_mp', function (Blueprint $table) {
            $table->increments('id');
            $table->string('genero')->nullable(); // Masculino, Femenino
            $table->string('escolaridad')->nullable();
            $table->string('ocupacion')->nullable();
            $table->json('categorias')->nullable();  // Apoderado Legal, LGBTI Integra Comunidad, LGBTI Nombre Asumido, Infante, Adolescente, Menor Adulto, Adulto, Adulto Mayor,
            $table->json('tipo_identificacion')->nullable(); //Fé Publica, Testigo Protegido, Anonimo, Ocultar Identidad, Conocido, De Oficio
            $table->json('alias')->nullable(); //array de alias
            $table->string('discapacidad')->nullable();
            $table->string('pueblo_indigena')->nullable();
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
        Schema::dropIfExists('personas_naturales_mp');
    }
}
