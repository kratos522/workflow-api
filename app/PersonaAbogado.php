<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonaAbogado extends Model
{
   protected $table = "personas_abogados";
   protected $attributes = ["identificacion_colegio_abogados" => null];

   public function persona()
   {
       return $this->belongsTo(Persona::class);
   }
}
