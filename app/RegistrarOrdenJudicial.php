<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegistrarOrdenJudicial extends Model
{
  public function ordenjudicial()
  {
      return $this->hasOne(OrdenJudicial::class, 'id_orden');
  }
}
