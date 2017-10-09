<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CaserioMP extends Model
{

  protected $table = "caserios_mp";
  protected $attributes = ['nombre'=>null];
  public function barrio()
  {
      return $this->belongsTo(BarrioMP::class, 'barrio_mp_id');
  }

  public function domicilios()
  {
      return $this->hasMany(Domicilio::class, 'caserio_mp_id','id');
  }

  public function lugares()
  {
      return $this->hasMany(LugarMP::class, 'caserio_mp_id','id');
  }

}
