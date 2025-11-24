<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Propietario extends Model
{
    protected $table = 'propietarios';
    protected $primaryKey = 'id_propietario';
    public $timestamps = false;

    protected $fillable = [
        'razon_social',
        'nit',
        'representante_legal',
        'activo'
    ];

    public function vehiculos()
    {
        return $this->hasMany(Vehiculo::class, 'id_propietario', 'id_propietario');
    }
}