<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ForcePasswordEncryption extends Seeder
{
    public function run()
    {
        echo "🔍 Verificando contraseñas en la base de datos...\n";
        
        $users = DB::table('usuarios')->get();
        $encrypted = 0;
        
        foreach ($users as $user) {
            // Si la contraseña NO empieza con $2y$ (bcrypt), encriptarla
            if (!str_starts_with($user->contrasena, '$2y$')) {
                DB::table('usuarios')
                    ->where('id_usuario', $user->id_usuario)
                    ->update([
                        'contrasena' => Hash::make($user->contrasena)
                    ]);
                
                echo "✅ {$user->correo} - Contraseña encriptada\n";
                $encrypted++;
            } else {
                echo "⏭️  {$user->correo} - Ya estaba encriptada\n";
            }
        }
        
        echo "\n📊 Resumen:\n";
        echo "   - Contraseñas encriptadas: {$encrypted}\n";
        echo "   - Total de usuarios: " . count($users) . "\n";
    }
}