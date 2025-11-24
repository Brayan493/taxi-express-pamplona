<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    // Nombre de TU tabla
    protected $table = 'usuarios';
    
    // TU primary key
    protected $primaryKey = 'id_usuario';

    // Campos que puedes llenar
    protected $fillable = [
        'nombre',
        'apellido',
        'correo',
        'contrasena',
        'id_rol',
        'activo'
    ];

    // Campos ocultos
    protected $hidden = [
        'contrasena',
    ];

    // Sin timestamps automáticos de Laravel
    public $timestamps = false;

    // Mapear el campo de email para autenticación
    public function getAuthIdentifierName()
    {
        return 'correo';
    }

    // Mapear el campo de password para autenticación
    public function getAuthPassword()
    {
        return $this->contrasena;
    }

    // Laravel espera un campo 'password', pero tú tienes 'contrasena'
    public function getPasswordAttribute()
    {
        return $this->contrasena;
    }

    // Relación con la tabla roles
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'id_rol', 'id_rol');
    }

    // Accessor para obtener el nombre del rol como string
    public function getNombreRolAttribute()
    {
        // Mapeo de id_rol a nombre de rol según tu base de datos
        $rolesMap = [
            1 => 'admin',
            2 => 'operadora',
            3 => 'conductor',
            4 => 'conductor',
            5 => 'conductor',
            6 => 'conductor',
            7 => 'conductor',
            8 => 'conductor',
            9 => 'conductor',
            10 => 'conductor',
            11 => 'conductor',
            12 => 'conductor',
        ];

        return $rolesMap[$this->attributes['id_rol']] ?? 'conductor';
    }

    // ✅ MÉTODO AGREGADO: Verificar si el usuario es administrador
    public function esAdministrador()
    {
        return $this->id_rol === 1;
    }

    // OPCIONAL: Otros métodos útiles
    public function esOperadora()
    {
        return $this->id_rol === 2;
    }

    public function esConductor()
    {
        return $this->id_rol >= 3;
    }
}