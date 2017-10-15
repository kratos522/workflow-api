<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LugarMP extends Model
{

  public function institucion(){
      return $this->morphOne(Lugar::class, 'institucionable');
  }

  public function persona_natural()
  {
      return $this->belongsTo(PersonaNaturalMP::class, 'persona_natural_mp_id');
  }

  public function departamento()
  {
      return $this->belongsTo(Departamento::class);
  }

  public function municipio()
  {
      return $this->belongsTo(Municipio::class);
  }

  public function caserio()
  {
      return $this->belongsTo(CaserioMP::class);
  }

  public function Barrio()
  {
      return $this->belongsTo(BarrioMP::class);
  }

  public function Aldea()
  {
      return $this->belongsTo(AldeaMP::class);
  }
}
