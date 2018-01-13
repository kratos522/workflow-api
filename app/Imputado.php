<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Imputado extends Model
{
  protected $attributes = ['condicion'=>null, 'moviles'=>null, 'objetos'=>null, 'transportes'=>null, 'armas'=>null];

  protected $casts = [
      'moviles' => 'array',
      'objetos' => 'array',
      'transportes' => 'array',
      'armas' => 'array'
  ];

  public function rol(){
      return $this->morphOne(Rol::class, 'rolable');
  }

  public function denuncia()
  {
      return $this->belongsTo(Denuncia::class);
  }

  public function fiscales()
  {
      return $this->hasMany(FiscalAsignado::class);
  }

  public function fiscalias()
  {
      return $this->hasMany(FiscaliaAsignada::class);
  }

  public function delitos()
  {
      return $this->hasMany(DelitoAtribuido::class);
  }
}
