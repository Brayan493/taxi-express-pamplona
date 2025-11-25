<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    public function up()
    {
        echo "🔒 Encriptando contraseñas en texto plano...\n";
        
        $users = DB::table('usuarios')->get();
        $encrypted = 0;
        
        foreach ($users as $user) {
            // Si la contraseña NO está encriptada (no empieza con $2y$)
            if (!str_starts_with($user->contrasena, '$2y$')) {
                DB::table('usuarios')
                    ->where('id_usuario', $user->id_usuario)
                    ->update([
                        'contrasena' => Hash::make($user->contrasena)
                    ]);
                
                echo "✅ {$user->correo} - Encriptada\n";
                $encrypted++;
            }
        }
        
        echo "📊 Total encriptadas: $encrypted\n";
    }

    public function down()
    {
        // No se puede revertir
    }
};