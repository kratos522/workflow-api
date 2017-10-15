<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FuncionarioSS extends Model
{
  protected $table = "funcionarios_ss";
  protected $attributes = ['placa'=>null];

  public function institucion(){
      return $this->morphOne(Funcionario::clss, 'institucionable');
  }

  public function departamento()
  {
      return $this->belongsTo(Dependencia::class,'departamento_ss_id', 'id');
  }

  public function unidad()
  {
      return $this->belongsTo(Dependencia::class,'unidad_ss_id', 'id');
  }

  public function seccion()
  {
      return $this->belongsTo(Dependencia::class,'seccion_ss_id', 'id');
  }

}
