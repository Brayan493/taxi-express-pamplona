#!/bin/bash
set -e

echo "🚀 Iniciando aplicación Laravel..."

# Verificar assets
if [ ! -d "/var/www/html/public/build" ]; then
    echo "❌ ERROR: public/build no existe!"
    exit 1
fi

echo "✅ Directorio public/build encontrado"
echo "📦 Contenido de public/build:"
ls -lah /var/www/html/public/build/ || true

# SIEMPRE limpiar cachés al iniciar
echo "🧹 Limpiando cachés..."
php artisan optimize:clear || true
php artisan config:clear || true
php artisan cache:clear || true
php artisan view:clear || true
php artisan route:clear || true

# Verificar APP_KEY
if [ -z "$APP_KEY" ]; then
    echo "⚠️  WARNING: APP_KEY no está configurada"
    php artisan key:generate --force
fi

# Crear enlaces simbólicos
echo "🔗 Creando enlaces simbólicos..."
php artisan storage:link 2>/dev/null || echo "Storage link ya existe"

# Optimizar para producción
if [ "$APP_ENV" = "production" ]; then
    echo "⚙️  Optimizando para producción..."
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
fi

# Migraciones opcionales
if [ "$RUN_MIGRATIONS" = "true" ]; then
    echo "🗄️  Ejecutando migraciones..."
    php artisan migrate --force || echo "⚠️  Migraciones fallaron"
fi

echo "📊 Información de la aplicación:"
php artisan about || true

echo ""
echo "✅ Inicialización completada"
echo "🌐 Servidor escuchando en puerto 10000"
echo ""

# Iniciar Apache
exec apache2-foreground