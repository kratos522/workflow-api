<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AldeaSS extends Model
{
  protected $table = "aldeas_ss";
  protected $attributes = ['aldea'=>null];

  public function sector()
  {
      return $this->belongsTo(SectorSS::class, 'sector_ss_id');
  }

  public function colonia()
  {
      return $this->belongsTo(ColoniaSS::class, 'colonia_ss_id');
  }
}
