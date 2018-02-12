<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Brexis\LaravelWorkflow\Traits\WorkflowTrait;

class DenunciaSS extends Model
{
  use WorkflowTrait;

  protected $table = "denuncias_ss";
  protected $attributes =  ['numero_denuncia'=>null,'workflow_state'=>null];

  public function institucion(){
      return $this->morphOne(Denuncia::class, 'institucionable');
  }

  public function formable(){
      return $this->morphTo();
  }
}
