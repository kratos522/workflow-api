<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Victima extends Model
{
  protected $attributes = ['residente'=>null];

  public function rol(){
      return $this->morphOne('Rol', 'rolable');
  }

  public function denuncia()
  {
      return $this->belongsTo(Denuncia::class);
  }
}
