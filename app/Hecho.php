<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hecho extends Model
{
  protected $attributes = ['narracion'=>null, 'fecha_ocurrencia'=>null];

  public function hechos()
  {
      return $this->belongsTo(Lugar::class);
  }

  public function denuncia()
  {
      return $this->belongsTo(Denuncia::class);
  }
}
