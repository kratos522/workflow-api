<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CiudadSS extends Model
{
  protected $table = "ciudades_ss";
  protected $attributes = ['ciudad'=>null];

  public function departamento()
  {
      return $this->belongsTo(Departamento::class, 'departamento_id');
  }

  public function municipio()
  {
      return $this->belongsTo(Municipio::class, 'municipio_id');
  }

  public function colonias()
  {
      return $this->hasMany(ColoniaSS::class, 'ciudad_ss_id', 'id');
  }

}
