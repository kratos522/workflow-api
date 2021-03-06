<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DelitoContraPropiedadSS extends Model
{
    protected $table = "delitoscontrapropiedades_ss";

    public function solicitud(){
        return $this->morphOne(Solicitud::class, 'solicitable');
    }
}
