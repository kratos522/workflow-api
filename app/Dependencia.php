<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dependencia extends Model
{
  protected $attributes = ['nombre'=>null];

  public function institucion()
  {
      return $this->belongsTo(Institucion::class);
  }

  public function roles()
  {
      return $this->hasMany(Rol::class);
  }

  public function denuncias_ss()
  {
      return $this->hasMany(DenunciaFuenteFormal::class);
  }

  public function denuncias_recepcionadas_mp()
  {
      return $this->hasMany(DenunciaMP::class, 'recepcionada_en', 'ids');
  }

  public function expedientes()
  {
      return $this->hasMany(Expediente::class);
  }

  public function documentos()
  {
      return $this->hasMany(Documento::class);
  }

  public function fiscalias()
  {
      return $this->hasMany(Fiscalia::class);
  }
}
