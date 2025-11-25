<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLoginForm()
    {
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

        // ✅ SOLUCIÓN: Autenticación manual
        $user = User::where('correo', $credentials['correo'])->first();

        // Verificar que el usuario exista y la contraseña sea correcta
        if ($user && Hash::check($credentials['contrasena'], $user->contrasena)) {
            
            // Verificar que el usuario esté activo
            if (!$user->activo) {
                return back()->withErrors([
                    'correo' => 'Tu cuenta está inactiva. Contacta al administrador.',
                ])->onlyInput('correo');
            }

            // ✅ Iniciar sesión manualmente
            Auth::login($user, $request->boolean('remember'));
            $request->session()->regenerate();
            
            // Redirigir según rol
            if ($user->id_rol === 1) {
                return redirect()->route('admin.dashboard');
            } elseif ($user->id_rol === 2) {
                return redirect()->route('operadora.dashboard');
            } elseif ($user->id_rol >= 3) {
                return redirect()->route('conductor.dashboard');
            }
            
            // Si no tiene un rol válido
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

        return redirect()->route('home')->with('success', 'Sesión cerrada correctamente');
    }
}