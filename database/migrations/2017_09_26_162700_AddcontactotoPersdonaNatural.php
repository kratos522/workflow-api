<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddcontactotoPersdonaNatural extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('personas_naturales', function($table) {
        $table->json('telefonos')->nullable();
        $table->json('correos_electronicos')->nullable();
        $table->json('apartados_postales')->nullable();
        $table->string('telefono_notificacion')->nullable();
        $table->string('correo_notificacion')->nullable();
        $table->string('apartado_postal_notificacion')->nullable();                                              
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
