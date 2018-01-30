<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Brexis\LaravelWorkflow\Traits\WorkflowTrait;

class RetratoHablado extends Model
{
  use WorkflowTrait;

    public function solicitud(){
        return $this->morphOne(Solicitud::class, 'solicitable');
    }
}
