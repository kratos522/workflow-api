<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DelitoSS extends Model
{
  protected $table = "delitos_ss";

  public function institucion(){
      return $this->morphOne(Delito::class, 'institucionable');
  }
}
