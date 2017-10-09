<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentoFisico extends Model
{
  protected $table = "documentos_fisicos";  
  public function documento(){
      return $this->morphOne('Documento', 'tipoable');
  }
}
