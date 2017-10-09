<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Denunciado extends Model
{
  public function rol(){
      return $this->morphOne('Rol', 'rolable');
  }

  public function denuncia()
  {
      return $this->belongsTo(Denuncia::class);
  }

}
