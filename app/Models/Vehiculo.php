<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    protected $table = 'vehiculos';
    protected $primaryKey = 'id_vehiculo';
    public $timestamps = false;

    protected $fillable = [
        'placa',
        'numero_interno',
        'id_propietario',
        'marca',
        'modelo',
        'anio',
        'color',
        'cilindraje',
        'capacidad_pasajeros',
        'tipo_combustible',
        'fecha_soat',
        'fecha_tecnicomecanica',
        'fecha_poliza_contractual',
        'fecha_poliza_todo_riesgo',
        'tarjeta_propiedad',
        'licencia_transito',
        'estado',
        'fecha_vinculacion'
    ];

    protected $casts = [
        'fecha_soat' => 'date',
        'fecha_tecnicomecanica' => 'date',
        'fecha_poliza_contractual' => 'date',
        'fecha_poliza_todo_riesgo' => 'date',
        'fecha_vinculacion' => 'date',
    ];

    public function propietario()
    {
        return $this->belongsTo(Propietario::class, 'id_propietario', 'id_propietario');
    }

    public function turnos()
    {
        return $this->hasMany(TurnoObligatorio::class, 'id_vehiculo', 'id_vehiculo');
    }

    public function alertas()
    {
        return $this->hasMany(Alerta::class, 'id_vehiculo', 'id_vehiculo');
    }
}