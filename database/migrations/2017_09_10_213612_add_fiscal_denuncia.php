<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFiscalDenuncia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('denuncias', function($table) {
          $table->integer('fiscalia_id')->nullable();
          $table->integer('fiscal_id')->nullable();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('denuncias', function($table) {
          $table->integer('fiscalia_id')->nullable();
          $table->integer('fiscal_id')->nullable();
      });
    }
}
