<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirigiendo...</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .loader {
            text-align: center;
            color: white;
        }
        .spinner {
            border: 5px solid rgba(255,255,255,0.3);
            border-top: 5px solid white;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
            margin: 0 auto 20px;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <div class="loader">
        <div class="spinner"></div>
        <h2>Redirigiendo al dashboard...</h2>
        <p>Por favor espera</p>
    </div>

    <script>
        // Redirección inmediata con JavaScript
        <?php if(Auth::user()->esAdministrador()): ?>
            window.location.href = "<?php echo e(route('dashboard.admin')); ?>";
        <?php elseif(Auth::user()->esOperadora()): ?>
            window.location.href = "<?php echo e(route('dashboard.operadora')); ?>";
        <?php elseif(Auth::user()->esConductor()): ?>
            window.location.href = "<?php echo e(route('dashboard.conductor')); ?>";
        <?php else: ?>
            window.location.href = "<?php echo e(route('login')); ?>";
        <?php endif; ?>
    </script>
</body>
</html><?php /**PATH C:\Users\Usuario\Desktop\TRABAJO DE GRADO\proyecto-login\proyecto-login\proyecto-login\resources\views\dashboard.blade.php ENDPATH**/ ?>