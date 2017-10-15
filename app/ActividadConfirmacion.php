<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActividadConfirmacion extends Model
{
  protected $table = "actividades_confirmacion";
  protected $attributes =  ['descripcion'=>null];

  public function denuncia()
  {
      return $this->belongsTo(App\DenunciaFuenteNoFormal::class, 'denuncia_fuente_no_formal_id');
  }
}
