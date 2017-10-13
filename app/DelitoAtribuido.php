<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DelitoAtribuido extends Model
{
    protected $table = "delitos_atribuidos";

    public function denuncia()
    {
        return $this->belongsTo(Denuncia::class);
    }

    public function imputado()
    {
        return $this->belongsTo(Imputado::class);
    }

    public function sospechoso()
    {
        return $this->belongsTo(Sospechoso::class);
    }

    public function delito()
    {
        return $this->belongsTo(Delito::class);
    }

    public function fiscales_asignados()
    {
        return $this->hasMany(FiscalAsignado::class,'delito_atribuido_id', 'id');
    }

}
