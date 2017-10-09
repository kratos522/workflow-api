<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DenunciaSS extends Model
{
  protected $table = "denuncias_ss";
  protected $attributes =  ['numero_denuncia'=>null];

  public function institucion(){
      return $this->morphOne('Denuncia', 'institucionable');
  }

  public function formable(){
      return $this->morphTo();
  }
}
