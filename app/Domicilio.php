<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Domicilio extends Model
{
  protected $attributes = ['descripcion'=>null];

  public function persona()
  {
      return $this->belongsTo(Persona::class);
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
