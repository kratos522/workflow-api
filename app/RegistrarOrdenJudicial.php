<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Brexis\LaravelWorkflow\Traits\WorkflowTrait;

class RegistrarOrdenJudicial extends Model
{
use WorkflowTrait;

  public function ordenjudicial()
  {
      return $this->hasOne(OrdenJudicial::class, 'id_orden');
  }
}
