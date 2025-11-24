<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ControlTurno extends Model
{
    protected $table = 'control_turnos';
    protected $primaryKey = 'id_control';
    public $timestamps = false;

    protected $fillable = [
        'id_turno',
        'id_operadora',
        'nombre_franja',
        'hora_inicio',
        'hora_fin',
        'cruza_medianoche',
        'hora_llamado',
        'respondio',
        'en_servicio'
    ];

    protected $casts = [
        'respondio' => 'boolean',
        'en_servicio' => 'boolean',
        'cruza_medianoche' => 'boolean',
    ];

    // Relación con TurnoObligatorio
    public function turno()
    {
        return $this->belongsTo(TurnoObligatorio::class, 'id_turno', 'id_turno');
    }

    // Relación con Usuario (operadora)
    public function operadora()
    {
        return $this->belongsTo(User::class, 'id_operadora', 'id_usuario');
    }
}