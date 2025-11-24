<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TurnoObligatorio extends Model
{
    protected $table = 'turnos_obligatorios';
    protected $primaryKey = 'id_turno';
    public $timestamps = false;

    protected $fillable = [
        'id_vehiculo',
        'id_conductor',
        'fecha_turno',
        'estado',
        'asignado_por'
    ];

    protected $casts = [
        'fecha_turno' => 'date',
    ];

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class, 'id_vehiculo', 'id_vehiculo');
    }

    public function conductor()
    {
        return $this->belongsTo(Conductor::class, 'id_conductor', 'id_conductor');
    }

    public function asignadoPor()
    {
        return $this->belongsTo(User::class, 'asignado_por', 'id_usuario');
    }

    public function controlTurnos()
    {
        return $this->hasMany(ControlTurno::class, 'id_turno', 'id_turno');
    }
}