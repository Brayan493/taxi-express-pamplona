<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Verificar que el usuario esté autenticado
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();
        
        // Mapeo de nombres de roles a IDs
        $rolesMap = [
            'admin' => 1,
            'administrador' => 1,
            'operadora' => 2,
            'conductor' => [3, 4, 5, 6, 7, 8, 9, 10, 11, 12],
        ];

        // Verificar si el usuario tiene alguno de los roles permitidos
        foreach ($roles as $role) {
            $roleIds = $rolesMap[$role] ?? null;
            
            if ($roleIds) {
                if (is_array($roleIds)) {
                    if (in_array($user->id_rol, $roleIds)) {
                        return $next($request);
                    }
                } else {
                    if ($user->id_rol === $roleIds) {
                        return $next($request);
                    }
                }
            }
        }

        // Si no tiene el rol adecuado, redirigir al home o mostrar error
        abort(403, 'No tienes permiso para acceder a esta página.');
    }
}