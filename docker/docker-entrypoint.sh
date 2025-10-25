#!/bin/bash
set -e

echo "🚀 Iniciando aplicación Laravel..."

# Verificar que existan los archivos compilados
if [ ! -d "/var/www/html/public/build" ]; then
    echo "❌ ERROR: public/build no existe!"
    exit 1
fi

echo "✅ Directorio public/build encontrado"

# Limpiar cachés de Laravel
echo "🧹 Limpiando cachés..."
php artisan config:clear || true
php artisan cache:clear || true
php artisan view:clear || true
php artisan route:clear || true

# Verificar si existe APP_KEY
if [ -z "$APP_KEY" ]; then
    echo "⚠️  WARNING: APP_KEY no está configurada"
    echo "Generando una temporal..."
    php artisan key:generate --force
fi

# Crear enlaces simbólicos de storage
echo "🔗 Creando enlaces simbólicos..."
php artisan storage:link || true

# Optimizar para producción si está en production
if [ "$APP_ENV" = "production" ]; then
    echo "⚙️  Optimizando para producción..."
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
fi

# Migrar base de datos si está configurada
if [ "$RUN_MIGRATIONS" = "true" ]; then
    echo "🗄️  Ejecutando migraciones..."
    php artisan migrate --force || echo "⚠️  Migraciones fallaron, continuando..."
fi

# Mostrar información del sistema
echo "📊 Información de la aplicación:"
php artisan about || true

echo ""
echo "✅ Inicialización completada"
echo "🌐 Servidor escuchando en puerto 10000"
echo ""

# Iniciar Apache en primer plano
exec apache2-foreground