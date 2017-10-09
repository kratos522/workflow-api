<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropDiscapacidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('discapacidades');
        Schema::dropIfExists('moviles');
        Schema::dropIfExists('moviles_imputados');
        Schema::dropIfExists('objetos');
        Schema::dropIfExists('objetos_imputados');
        Schema::dropIfExists('transportes');
        Schema::dropIfExists('transportes_imputados');
        Schema::dropIfExists('armas');
        Schema::dropIfExists('armas_imputados');
        Schema::dropIfExists('fiscales_imputados');

        Schema::table('denuncias', function($table) {
          $table->dropColumn(['fiscal_id']);
          $table->dropColumn(['fiscalia_id']);
        });

        Schema::table('imputados', function($table) {
          $table->json('moviles')->nullable();
          $table->json('objetos')->nullable();
          $table->json('transportes')->nullable();
          $table->json('armas')->nullable();
        });

        Schema::create('fiscalias_asignadas', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha_asignacion');
            $table->integer('fiscalia_id');
            $table->integer('imputado_id');
            $table->integer('denuncia_id');
            $table->boolean('deleted')->default(false);
            $table->timestamps();
        });

        // Schema::dropIfExists('fiscales_asignados');
        Schema::create('fiscales_asignados', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha_asignacion');
            $table->integer('fiscalia_asignada_id');
            $table->index('fiscalia_asignada_id');
            //$table->foreign('fiscalia_asignada_id')->references('id')->on('fiscalias_asignadas')->onDelete('cascade');
            $table->integer('fiscal_id');
            $table->integer('imputado_id');
            $table->integer('denuncia_id');
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
        //
    }
}
