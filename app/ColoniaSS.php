<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ColoniaSS extends Model
{
  protected $table = "colonias_ss";
  protected $attributes = ['colonia'=>null];

  public function ciudad()
  {
      return $this->belongsTo(CiudadSS::class, 'ciudad_ss_id');
  }

  public function zonas()
  {
      return $this->hasMany(ZonaSS::class, 'colonia_ss_id', 'id');
  }

  public function aldeas()
  {
      return $this->hasMany(AldeaSS::class,'colonia_ss_id','id');
  }

}
