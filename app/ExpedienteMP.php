<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpedienteMP extends Model
{
  protected $table = "expedientes_mp";
  protected $attributes = ['numero_expediente'=>null, 'numero_expediente_policial'=>null, 'numero_expediente_judicial'=>null, 'numero_expediente_sedi'=>null];

  public function institucion(){
      return $this->morphOne(Expediente::class, 'institucionable');
  }

}
