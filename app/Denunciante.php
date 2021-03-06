<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Denunciante extends Model
{
  public function rol(){
      return $this->morphOne(Rol::class, 'rolable');
  }

  public function denuncia()
  {
      return $this->belongsTo(Denuncia::class);
  }
}
