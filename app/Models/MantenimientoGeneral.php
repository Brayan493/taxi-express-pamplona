<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MantenimientoGeneral extends Model
{
    protected $table = 'mantenimiento_general';
    protected $primaryKey = 'id_mantenimiento_general';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'descripcion',
        'cambio_neumaticos',
        'kilometraje_recomendado',
        'es_preventivo',
        'activo'
    ];

    protected $casts = [
        'es_preventivo' => 'boolean',
        'activo' => 'boolean',
    ];
}