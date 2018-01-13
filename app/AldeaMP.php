<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class AldeaMP extends Model
{
  protected $table =  "aldeas_mp";

  protected $attributes =  ["nombre"=>null];

  public function municipio()
  {
      return $this->belongsTo(Municipio::class);
  }

  public function barrios()
  {
      return $this->hasMany(BarrioMP::class, 'aldea_mp_id', 'id');
  }

  public function domicilios()
  {
      return $this->hasMany(Domicilio::class, 'aldea_mp_id', 'id');
  }

  public function lugares()
  {
      return $this->hasMany(LugarMP::class, 'aldea_mp_id', 'id');
  }

}
