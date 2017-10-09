<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{

  public function documentable(){
      return $this->morphTo();
  }

  public function tipoable(){
      return $this->morphTo();
  }

  public function expediente()
  {
      return $this->belongsTo(Expediente::class);
  }


  public function lugares()
  {
      return $this->hasOne(Lugar::class);
  }

  public function institucion()
  {
      return $this->belongsTo(Institucion::class);
  }

  public function dependencia()
  {
      return $this->belongsTo(Dependencia::class);
  }
}
