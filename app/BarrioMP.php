<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BarrioMP extends Model
{

  protected $table = "barrios_mp";
  protected $attributes = ['nombre'=>null];
  public function aldea()
  {
      return $this->belongsTo(AldeaMP::class, 'aldea_mp_id');
  }

  public function caserios()
  {
      return $this->hasMany(CaserioMP::class,'barrio_mp_id', 'id');
  }

  public function domicilios()
  {
      return $this->hasMany(Domicilio::class, 'barrio_mp_id', 'id');
  }

  public function lugares()
  {
      return $this->hasMany(LugarMP::class, 'barrio_mp_id', 'id');
  }

}
