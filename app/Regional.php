<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Regional extends Model
{
  protected $table = "regionales";
  protected $attributes =  ['regional'=>null];  

  public function departamentos()
  {
      return $this->hasMany(Departamento::class);
  }
}
