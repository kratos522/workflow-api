<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Brexis\LaravelWorkflow\Traits\WorkflowTrait;

class DenunciaMP extends Model
{
  use WorkflowTrait;

  protected $table = "denuncias_mp";
  protected $attributes =  ['numero_denuncia'=>null, 'recepcionada_en'=>null, 'workflow_state'=>null];

  public function institucion(){
      return $this->morphOne('Denuncia', 'institucionable');
  }

  public function recepcionada_en()
  {
      return $this->belongsTo(Dependencia::class, 'recepcionada_en');
  }
}
