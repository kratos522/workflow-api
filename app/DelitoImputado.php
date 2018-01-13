<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DelitoImputado extends Model
{
  protected $table = "delitos_imputados";
  protected $attributes = ['culposo'=>false];

  public function imputado()
  {
      return $this->belongsTo(Imputado::class);
  }

  public function delito()
  {
      return $this->belongsTo(Delito::class);
  }
}
