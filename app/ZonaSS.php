<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ZonaSS extends Model
{
  protected $table = "zonas_ss";
  protected $attributes = ['zona'=>null];

  public function colonia()
  {
      return $this->belongsTo(ColoniaSS::class, 'colonia_ss_id');
  }

  public function sectores()
  {
      return $this->hasMany(SectorSS::class, 'zona_ss_id', 'id');
  }
}
