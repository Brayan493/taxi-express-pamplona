<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';

    protected $fillable = [
        'nombre',
        'Apellido',
        'correo',
        'contrasena',
        'id_rol',
        'activo',
    ];

    protected $hidden = [
        'contrasena',
        'remember_token',
    ];

    protected $casts = [
        'activo' => 'boolean',
    ];

    public function getAuthPassword()
    {
        return $this->contrasena;
    }

    public function getAuthPasswordName()
    {
        return 'contrasena';
    }

    // ✅ MÉTODOS HELPER PARA VERIFICAR ROLES
    
    /**
     * Verificar si el usuario es administrador
     */
    public function esAdministrador()
    {
        return $this->id_rol === 1;
    }

    /**
     * Verificar si el usuario es operadora
     */
    public function esOperadora()
    {
        return $this->id_rol === 2;
    }

    /**
     * Verificar si el usuario es conductor
     */
    public function esConductor()
    {
        return $this->id_rol >= 3;
    }

    /**
     * Obtener el nombre del rol
     */
    public function getNombreRol()
    {
        $roles = [
            1 => 'Administrador',
            2 => 'Operadora',
            3 => 'Conductor',
        ];

        return $roles[$this->id_rol] ?? 'Desconocido';
    }
}