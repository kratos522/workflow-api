<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Brexis\LaravelWorkflow\Traits\WorkflowTrait;

class Flagrancia extends Model
{
use WorkflowTrait;
protected $table = "captura_flagrancia";

  public function captura()
  {
      return $this->hasMany(Captura::class, 'id_captura');
  }

  public function denuncia()
  {
      return $this->hasMany(Denuncia::class, 'id_denuncia');
  }

}
