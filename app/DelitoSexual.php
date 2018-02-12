<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DelitoSexual extends Model
{
  protected $table = "delitos_sexuales";
  protected $attributes = ['victima_embarazada'=>null,
                           'frecuencia'=>null,
                            'trabajo_remunerado'=>null,
                            'asiste_centro_vocacional' => null,
                            'cantidad_hijos'=>null];

  public function tipoable(){
      return $this->morphOne(Ofendido::class, 'tipoable');
  }
}
