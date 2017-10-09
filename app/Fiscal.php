<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fiscal extends Model
{
  protected $table = "fiscales";

  public function rol(){
      return $this->morphOne('Rol', 'rolable');
  }

  public function fiscalia()
  {
      return $this->belongsTo(Fiscalia::class);
  }

  public function imputados()
  {
      return $this->hasMany(FiscaleAsignado::class);
  }

  public function denuncias()
  {
      return $this->hasMany(Denuncia::class);
  }

  public function casos_asignados()
  {
      return $this->belongsTo(FiscalAsignado::class);
  }

}
