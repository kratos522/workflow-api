<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Brexis\LaravelWorkflow\Traits\WorkflowTrait;

class IntervencionComunicacion extends Model
{
use WorkflowTrait;

protected $table = "intervenciones_comunicaciones";

  public function denuncia()
  {
      return $this->belongsTo(Denuncia::class, 'id_denuncia');
  }

  public function expediente()
  {
      return $this->belongsTo(Expediente::class, 'id_expediente');
  }
}
