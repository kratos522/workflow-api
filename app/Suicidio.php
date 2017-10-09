<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suicidio extends Model
{
  protected $attributes = ['intentos_previos'=>null,
                           'antecedentes_enfermedad_mental' => null,
                            'mecanismo_de_muerte' => null];
  protected $casts = [
      'mecanismo_de_muerte' => 'array'
  ];

  public function tipoable(){
      return $this->morphOne('Ofendido', 'tipoable');
  }
}
