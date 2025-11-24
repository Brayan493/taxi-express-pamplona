<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alerta extends Model
{
    protected $table = 'alertas';
    protected $primaryKey = 'id_alerta';
    public $timestamps = false;

    protected $fillable = [
        'tipo_alerta',
        'id_vehiculo',
        'id_conductor',
        'titulo',
        'descripcion',
        'prioridad',
        'fecha_vencimiento',
        'leida',
        'resuelta'
    ];

    protected $casts = [
        'fecha_vencimiento' => 'date',
        'leida' => 'boolean',
        'resuelta' => 'boolean',
    ];

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class, 'id_vehiculo', 'id_vehiculo');
    }

    public function conductor()
    {
        return $this->belongsTo(Conductor::class, 'id_conductor', 'id_conductor');
    }
}