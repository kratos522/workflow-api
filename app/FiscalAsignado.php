<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FiscalAsignado extends Model
{
    protected $table = "fiscales_asignados";
    protected $attributes = ['fecha_asignacion'=>null];

    public function fiscal()
    {
        return $this->belongsTo(Fiscal::class);
    }

    public function imputado()
    {
        return $this->belongsTo(Imputado::class);
    }

    public function denuncia()
    {
        return $this->belongsTo(Denuncia::class);
    }

    public function fiscalia()
    {
        return $this->belongsTo(FiscaliaAsignada::class, 'fiscalia_asignada_id');
    }
}
