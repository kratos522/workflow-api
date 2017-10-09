<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sospechoso extends Model
{
  protected $attributes = ['detenido'=>null, 'remitido'=>null];

  public function rol(){
      return $this->morphOne('Rol', 'rolable');
  }

  public function denuncia()
  {
      return $this->belongsTo(Denuncia::class);
  }

}
