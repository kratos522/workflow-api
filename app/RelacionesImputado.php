<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RelacionesImputado extends Model
{
  protected $table = "relaciones_imputados";

  public function relacionable(){
      return $this->morphTo();
  }

  public function imputado()
  {
      return $this->belongsTo(Imputado::class);
  }

  public function parentesco()
  {
      return $this->belongsTo(Parentesco::class);
  }

}
