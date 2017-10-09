<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
  protected $attributes = ['nombre'=>null, 'codigo'=>null];

  public function departamento()
  {
      return $this->belongsTo(Departamento::class);
  }

  public function aldeas()
  {
      return $this->hasMany(AldeaMP::class);
  }

  public function domicilios()
  {
      return $this->hasMany(Domicilio::class);
  }

  public function ciudades()
  {
      return $this->hasMany(CiudadSS::class);
  }

  public function lugar_mp()
  {
      return $this->hasMany(LugarMP::class);
  }

  public function lugar_ss()
  {
      return $this->hasMany(LugarSS::class);
  }
}
