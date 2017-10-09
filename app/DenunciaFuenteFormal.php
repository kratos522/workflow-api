<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DenunciaFuenteFormal extends Model
{
  protected $table = "denuncias_fuentes_formales";

  public function denuncia(){
      return $this->morphOne('DenunciaSS', 'formable');
  }

  public function dependencia()
  {
      return $this->belongsTo(Dependencia::class);
  }

}
