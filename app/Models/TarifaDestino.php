<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TarifaDestino extends Model
{
    protected $table = 'tarifas_destinos';
    protected $primaryKey = 'id_tarifa';
    public $timestamps = false;

    protected $fillable = [
        'nombre_destino',
        'ciudad',
        'departamento',
        'tarifa_base',
        'fecha_vigencia_desde',
        'fecha_vigencia_hasta',
        'activa'
    ];

    protected $casts = [
        'fecha_vigencia_desde' => 'date',
        'fecha_vigencia_hasta' => 'date',
        'activa' => 'boolean',
    ];
}