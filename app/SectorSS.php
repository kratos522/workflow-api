<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SectorSS extends Model
{
  protected $table = "sectores_ss";
  protected $attributes = ['sector'=>null];

  public function zona()
  {
      return $this->belongsTo(ZonaSS::class, 'zona_ss_id');
  }

  public function aldeas()
  {
      return $this->hasMany(AldeaSS::class,'sector_ss_id','id');
  }

  public function lugares()
  {
      return $this->hasMany(LugarSS::class,'sector_ss_id','id');
  }
}
