<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anexo extends Model
{
  public function institucionable(){
      return $this->morphTo();
  }

  public function documento(){
      return $this->morphOne(Documento::class, 'documentable');
  }

}
