<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institucion extends Model
{
  protected $attributes = ['nombre'=>null];

  public function dependencias()
  {
      return $this->hasMany(Dependencia::class);
  }

  public function expedientes()
  {
      return $this->hasMany(Expediente::class);
  }

  public function documentos()
  {
      return $this->hasMany(Documento::class);
  }

  public function roles()
  {
      return $this->hasMany(Rol::class);
  }

}
