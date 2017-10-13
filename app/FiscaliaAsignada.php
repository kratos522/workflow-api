<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FiscaliaAsignada extends Model
{
    protected $table = "fiscalias_asignadas";
    protected $attributes = ['fecha_asignacion'=>null];

    public function fiscalia()
    {
        return $this->belongsTo(Fiscalia::class);
    }

    public function imputado()
    {
        return $this->belongsTo(Imputado::class);
    }

    public function sospechoso()
    {
        return $this->belongsTo(Sospechoso::class);
    }

    public function denuncia()
    {
        return $this->belongsTo(Denuncia::class);
    }

    public function fiscales_asignados()
    {
        return $this->belongsTo(FiscalAsignado::class,'fiscalia_asignada_id', 'id');
    }
}
