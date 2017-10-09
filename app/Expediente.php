<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expediente extends Model
{
  protected $attributes = ['numero_expediente'=>null, 'fecha_expediente'=>null];
  public function institucionable(){
      return $this->morphTo();
  }

  public function documentos()
  {
      return $this->hasMany(Documento::class);
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
