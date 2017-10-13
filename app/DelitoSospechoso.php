<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DelitoSospechoso extends Model
{
  protected $table = "delitos_sospechosos";

  public function sospechoso()
  {
      return $this->belongsTo(Sospechoso::class);
  }

  public function delito()
  {
      return $this->belongsTo(Delito::class);
  }
}
