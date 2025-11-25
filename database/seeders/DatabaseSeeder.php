<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        try {
            // Eliminar usuario admin si existe
            DB::table('usuarios')->where('correo', 'elder.garcia@gmail.com')->delete();
            
            // Crear usuario administrador
            DB::table('usuarios')->insert([
                'nombre' => 'Elder',
                'Apellido' => 'García',  // Agregar apellido
                'correo' => 'elder.garcia@gmail.com',
                'contrasena' => Hash::make('elder123'),
                'id_rol' => 1,
                'activo' => true,
            ]);
            
            echo "✅ Usuario admin creado en tabla 'usuarios'\n";
            echo "📧 Email: elder.garcia@gmail.com\n";
            echo "🔑 Contraseña: elder123\n";
        } catch (\Exception $e) {
            echo "❌ Error al crear usuario: " . $e->getMessage() . "\n";
        }
    }
}