<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class EncryptPasswords extends Command
{
    protected $signature = 'passwords:encrypt';
    protected $description = 'Encripta todas las contraseñas que estén en texto plano';

    public function handle()
    {
        $this->info('🔍 Buscando contraseñas en texto plano...');
        
        $usuarios = DB::table('usuarios')->get();
        $encriptadas = 0;
        $yaEncriptadas = 0;
        
        foreach ($usuarios as $usuario) {
            // Verificar si la contraseña ya está encriptada
            if (str_starts_with($usuario->contrasena, '$2y$')) {
                $this->line("✅ {$usuario->correo} - Ya encriptada");
                $yaEncriptadas++;
            } else {
                // Encriptar contraseña en texto plano
                DB::table('usuarios')
                    ->where('id_usuario', $usuario->id_usuario)
                    ->update([
                        'contrasena' => Hash::make($usuario->contrasena)
                    ]);
                
                $this->info("🔒 {$usuario->correo} - Encriptada");
                $encriptadas++;
            }
        }
        
        $this->newLine();
        $this->info("📊 Resumen:");
        $this->info("   - Contraseñas encriptadas: {$encriptadas}");
        $this->info("   - Ya estaban encriptadas: {$yaEncriptadas}");
        $this->info("   - Total: " . ($encriptadas + $yaEncriptadas));
    }
}