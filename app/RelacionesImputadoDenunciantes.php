<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RelacionesImputadoDenunciantes extends Model
{

  protected $table = "relaciones_imputados_denunciantes";

  public function relacion(){
      return $this->morphOne(RelacionesImputado::class, 'relacionable');
  }

}
