<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RelacionesImputadoOfendidos extends Model
{

  protected $table = "relaciones_imputados_ofendidos";

  public function relacion(){
      return $this->morphOne('RelacionesImputado', 'relacionable');
  }

}
