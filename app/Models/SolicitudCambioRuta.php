<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SolicitudCambioRuta extends Model
{
    use HasFactory;

    protected $table = 'solicitudes_cambio_ruta';
    protected $primaryKey = 'id_solicitud';
    public $timestamps = false;

    protected $fillable = [
        'id_conductor',
        'id_vehiculo',
        'id_tarifa_destino',
        'fecha_viaje_programada',
        'nombre_contratante',
        'documento_contratante',
        'telefono_contratante',
        'direccion_origen',
        'direccion_destino',
        'numero_pasajeros',
        'tarifa_cobrada',
        'autorizado_por',
        'fecha_solicitud',
        'fecha_inicio_real',
        'fecha_respuesta'
    ];

    protected $casts = [
        'fecha_solicitud' => 'datetime',
        'fecha_respuesta' => 'datetime'
    ];
    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class, 'id_vehiculo', 'id_vehiculo');
    }

    public function conductor()
    {
        return $this->belongsTo(Conductor::class, 'id_conductor', 'id_conductor');
    }

    public function tarifaDestino(){
        return $this->belongsTo(TarifaDestino::class, 'id_tarifa_destino', 'id_tarifa');
    }
     public function autorizadoPor()
    {
        return $this->belongsTo(User::class, 'autorizado_por', 'id_usuario');
        // O si usas User en lugar de Usuario:
        // return $this->belongsTo(User::class, 'autorizado_por', 'id');
    }
    
}