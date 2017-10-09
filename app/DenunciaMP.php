<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DenunciaMP extends Model
{
  protected $table = "denuncias_mp";
  protected $attributes =  ['numero_denuncia'=>null, 'recepcionada_en'=>null];

  public function institucion(){
      return $this->morphOne('Denuncia', 'institucionable');
  }

  public function recepcionada_en()
  {
      return $this->belongsTo(Dependencia::class, 'recepcionada_en');
  }
}
