<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Brexis\LaravelWorkflow\Traits\WorkflowTrait;

class CapturaFinExtradicion extends Model
{

use WorkflowTrait;

protected $table = "captura_fines_extradicion";

  public function orden_captura()
  {
      return $this->belongsTo(Orden::class, 'id_orden_captura');
  }

  public function nota_roja()
  {
      return $this->belongsTo(NotaRoja::class, 'id_nota_rota');
  }
}
