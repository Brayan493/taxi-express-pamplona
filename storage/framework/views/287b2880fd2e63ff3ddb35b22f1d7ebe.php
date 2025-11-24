<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Taxi Express Pamplona</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/login.css']); ?>
</head>
<body>
    <!-- Container principal -->
    <div class="container">
        <div class="login-card">
            <!-- Header con logo -->
            <div class="login-header">
                <div class="taxi-icon-header">
                    <img src="<?php echo e(asset('imagenes/logo.png')); ?>" alt="Logo Taxi Express Pamplona">
                </div>
                <div class="logo-text">
                    <span class="taxi">TAXI</span><span class="express">EXPRESS</span><br>
                    <span class="pamplona">PAMPLONA S.A.S</span>
                </div>
            </div>

            <!-- Formulario -->
            <form action="<?php echo e(route('login')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                
                <div class="form-group">
                    <label for="correo">Email</label>
                    <input 
                        type="email" 
                        id="correo" 
                        name="correo" 
                        placeholder="CORREO ELECTRONICO"
                        value="<?php echo e(old('correo')); ?>"
                        required
                        autofocus
                    >
                    <?php $__errorArgs = ['correo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="error-message"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="error-message"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="remember-group">
                    <input 
                        type="checkbox" 
                        id="remember" 
                        name="remember"
                        <?php echo e(old('remember') ? 'checked' : ''); ?>

                    >
                    <label for="remember">Remember me</label>
                </div>

                <button type="submit" class="btn-login">
                    Iniciar Sesión
                </button>
            </form>

            <!-- Footer -->
            <div class="login-footer">
                <?php if(Route::has('password.request')): ?>
                    <a href="<?php echo e(route('password.request')); ?>">¿Olvidaste tu contraseña?</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html><?php /**PATH C:\Users\Usuario\Desktop\TRABAJO DE GRADO\proyecto-login\proyecto-login\proyecto-login\resources\views/auth/login.blade.php ENDPATH**/ ?>