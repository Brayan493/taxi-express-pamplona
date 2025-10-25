#!/bin/bash
set -e

echo "🚀 Iniciando aplicación Laravel..."

# Verificar assets
if [ ! -d "/var/www/html/public/build" ]; then
    echo "❌ ERROR: public/build no existe!"
    exit 1
fi

echo "✅ Directorio public/build encontrado"

# LIMPIEZA AGRESIVA - Eliminar archivos de caché físicamente
echo "🧹 Limpiando cachés físicamente..."
rm -rf /var/www/html/storage/framework/views/*.php 2>/dev/null || true
rm -rf /var/www/html/storage/framework/cache/data/* 2>/dev/null || true
rm -rf /var/www/html/bootstrap/cache/*.php 2>/dev/null || true

# Limpiar cachés de Laravel
echo "🧹 Limpiando cachés de Laravel..."
php artisan view:clear || true
php artisan config:clear || true
php artisan cache:clear || true
php artisan route:clear || true
php artisan optimize:clear || true

# Verificar APP_KEY
if [ -z "$APP_KEY" ]; then
    echo "⚠️  WARNING: APP_KEY no está configurada"
    php artisan key:generate --force
fi

# Crear enlaces simbólicos
echo "🔗 Creando enlaces simbólicos..."
php artisan storage:link 2>/dev/null || echo "Storage link ya existe"

# NO CACHEAR en desarrollo - solo en producción
if [ "$APP_ENV" = "production" ] && [ "$APP_DEBUG" != "true" ]; then
    echo "⚙️  Optimizando para producción..."
    php artisan config:cache
    php artisan route:cache
    # NO cachear vistas si hay problemas
    # php artisan view:cache
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