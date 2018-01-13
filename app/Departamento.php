<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
  protected $attributes = ['nombre'=>null];
  // public function domicilio()
  // {
  //     return $this->belongsTo(Domicilio::class);
  // }

  public function municipios()
  {
      return $this->hasMany(Municipio::class);
  }

  public function domicilios()
  {
      return $this->hasMany(Domicilio::class);
  }

  public function regional()
  {
      return $this->belongsTo(Regional::class);
  }

  public function ciudades()
  {
      return $this->hasMany(CiudadSS::class);
  }

}
