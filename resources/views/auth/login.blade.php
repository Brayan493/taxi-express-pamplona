<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>Login - Taxi Express Pamplona</title>
    @vite(['resources/css/login.css'])
</head>
<body>
    @php
        // Regenerar token en cada carga para evitar expiración
        if(session()->isStarted()) {
            session()->regenerateToken();
        }
    @endphp

    <!-- Container principal -->
    <div class="container">
        <div class="login-card">
            <!-- Header con logo -->
            <div class="login-header">
                <div class="taxi-icon-header">
                    <img src="{{ asset('imagenes/logo.png') }}" alt="Logo Taxi Express Pamplona">
                </div>
                <div class="logo-text">
                    <span class="taxi">TAXI</span><span class="express">EXPRESS</span><br>
                    <span class="pamplona">PAMPLONA S.A.S</span>
                </div>
            </div>

            <!-- Formulario -->
            <form action="{{ route('login') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="correo">Email</label>
                    <input 
                        type="email" 
                        id="correo" 
                        name="correo" 
                        placeholder="CORREO ELECTRONICO"
                        value="{{ old('correo') }}"
                        required
                        autofocus
                    >
                    @error('correo')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="contrasena">Password</label>
                    <input 
                        type="password" 
                        id="contrasena" 
                        name="contrasena" 
                        placeholder="INGRESA TU CONTRASEÑA"
                        required
                    >
                    @error('contrasena')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="remember-group">
                    <input 
                        type="checkbox" 
                        id="remember" 
                        name="remember"
                        {{ old('remember') ? 'checked' : '' }}
                    >
                    <label for="remember">Remember me</label>
                </div>

                <button type="submit" class="btn-login">
                    Iniciar Sesión
                </button>
            </form>

            <!-- Footer -->
            <div class="login-footer">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
                @endif
            </div>
        </div>
    </div>
</body>
</html>