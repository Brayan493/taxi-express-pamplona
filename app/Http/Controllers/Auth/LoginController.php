<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        // Si ya está autenticado, redirigir a su dashboard
        if (Auth::check()) {
            $user = Auth::user();
            
            if ($user->id_rol === 1) {
                return redirect()->route('admin.dashboard');
            } elseif ($user->id_rol === 2) {
                return redirect()->route('operadora.dashboard');
            } elseif ($user->id_rol >= 3) {
                return redirect()->route('conductor.dashboard');
            }
        }
        
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'correo' => 'required|email',
            'contrasena' => 'required',
        ]);

        // Intentar autenticar
        if (Auth::attempt(['correo' => $credentials['correo'], 'password' => $credentials['contrasena']])) {
            $request->session()->regenerate();

            // ✅ Redirigir según el id_rol del usuario
            $user = Auth::user();
            
            if ($user->id_rol === 1) {
                return redirect()->route('admin.dashboard');
            } elseif ($user->id_rol === 2) {
                return redirect()->route('operadora.dashboard');
            } elseif ($user->id_rol >= 3) {
                return redirect()->route('conductor.dashboard');
            }
            
            // Fallback: cerrar sesión si no tiene rol válido
            Auth::logout();
            return redirect()->route('login')->with('error', 'No tienes un rol válido asignado');
        }

        return back()->withErrors([
            'correo' => 'Las credenciales no coinciden con nuestros registros.',
        ])->onlyInput('correo');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // ✅ Redirigir a la página de inicio (no al login)
        return redirect()->route('home')->with('success', 'Sesión cerrada correctamente');
    }
}