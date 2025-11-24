<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conductor extends Model
{
    protected $table = 'conductores';
    protected $primaryKey = 'id_conductor';
    public $timestamps = false;

    protected $fillable = [
        'tipo_documento',
        'numero_documento',
        'primer_nombre',
        'primer_apellido',
        'fecha_nacimiento',
        'genero',
        'celular',
        'email',
        'direccion',
        'numero_licencia',
        'categoria_licencia',
        'fecha_expedicion_licencia',
        'fecha_vencimiento_licencia',
        'restricciones_licencia',
        'id_usuario',
        'fecha_vinculacion',
        'fecha_retiro',
        'estado',
        'motivo_retiro'
    ];

    protected $casts = [
        'fecha_nacimiento' => 'date',
        'fecha_expedicion_licencia' => 'date',
        'fecha_vencimiento_licencia' => 'date',
        'fecha_vinculacion' => 'date',
        'fecha_retiro' => 'date',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario', 'id_usuario');
    }

    public function turnos()
    {
        return $this->hasMany(TurnoObligatorio::class, 'id_conductor', 'id_conductor');
    }

    public function solicitudesCambioRuta()
    {
        return $this->hasMany(SolicitudCambioRuta::class, 'id_conductor', 'id_conductor');
    }

    public function alertas()
    {
        return $this->hasMany(Alerta::class, 'id_conductor', 'id_conductor');
    }
}