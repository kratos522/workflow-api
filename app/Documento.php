<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Brexis\LaravelWorkflow\Traits\WorkflowTrait;

class Documento extends Model
{

  use WorkflowTrait;
  protected $attributes =  ['titulo'=>null,
                            'workflow_state'=>null,
                            'descripcion'=>null,
                            'fecha_documento'=>null,
                            'tags' => null                                                       
                          ];
  protected $casts = [
      'tags' => 'array',
  ];

  public function documentable(){
      return $this->morphTo();
  }

  public function tipoable(){
      return $this->morphTo();
  }

  public function expediente()
  {
      return $this->belongsTo(Expediente::class);
  }


  public function lugares()
  {
      return $this->hasOne(Lugar::class);
  }

  public function institucion()
  {
      return $this->belongsTo(Institucion::class);
  }

  public function dependencia()
  {
      return $this->belongsTo(Dependencia::class);
  }
}
