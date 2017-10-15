<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
  public function institucionable(){
      return $this->morphTo();
  }

  public function rol(){
      return $this->morphOne(Rol::class, 'rolable');
  }

  public function usuario()
  {
      return $this->hasOne(Usuario::class);
  }

  public function dependencia()
  {
      return $this->belongsTo(Dependencia::class);
  }

}
