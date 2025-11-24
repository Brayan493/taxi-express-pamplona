<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SolicitudCambioRuta extends Model
{
    protected $table = 'solicitudes_cambio_ruta';
    protected $primaryKey = 'id_solicitud';
    public $timestamps = false;

    protected $fillable = [
        'id_conductor',
        'id_vehiculo',
        'id_tarifa_destino',
        'fecha_solicitud',
        'fecha_viaje_programada',
        'nombre_contratante',
        'documento_contratante',
        'telefono_contratante',
        'direccion_origen',
        'direccion_destino',
        'numero_pasajeros',
        'autorizado_por',
        'fecha_autorizacion',
        'fecha_inicio_real',
        'fecha_fin_real',
        'tarifa_cobrada'
    ];

    /**
     * Relación con Conductor
     */
    public function conductor()
    {
        return $this->belongsTo(Conductor::class, 'id_conductor', 'id_conductor');
    }

    /**
     * Relación con Vehículo
     */
    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class, 'id_vehiculo', 'id_vehiculo');
    }

    /**
     * Relación con Tarifa Destino
     */
    public function tarifaDestino()
    {
        return $this->belongsTo(TarifaDestino::class, 'id_tarifa_destino', 'id_tarifa');
    }

    /**
     * Relación con Usuario que autorizó
     */
    public function autorizadoPor()
    {
        return $this->belongsTo(Usuario::class, 'autorizado_por', 'id_usuario');
    }
}