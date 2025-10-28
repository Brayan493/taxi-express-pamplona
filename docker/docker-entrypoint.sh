#!/bin/bash
set -e

echo "🚀 Iniciando aplicación Laravel en Render Free..."

# Verificar assets compilados
if [ ! -d "/var/www/html/public/build" ]; then
    echo "❌ ERROR: public/build no existe!"
    exit 1
fi

echo "✅ Assets compilados encontrados:"
ls -lah /var/www/html/public/build/ | head -10

# PERMISOS COMPLETOS
echo "🔐 Configurando permisos..."
chown -R www-data:www-data /var/www/html/storage
chown -R www-data:www-data /var/www/html/bootstrap/cache
chmod -R 777 /var/www/html/storage
chmod -R 777 /var/www/html/bootstrap/cache

# DESTRUCCIÓN NUCLEAR DE CACHÉS
echo "💣 ELIMINACIÓN TOTAL DE CACHÉS..."

# Eliminar TODOS los archivos de framework
find /var/www/html/storage/framework/views -type f -delete 2>/dev/null || true
find /var/www/html/storage/framework/cache -type f -delete 2>/dev/null || true
find /var/www/html/bootstrap/cache -type f -name "*.php" -delete 2>/dev/null || true

# Recrear estructura
mkdir -p /var/www/html/storage/framework/{views,cache/data,sessions,testing}
chmod -R 777 /var/www/html/storage/framework

# Artisan clear TODO
php artisan optimize:clear 2>/dev/null || true
php artisan view:clear 2>/dev/null || true
php artisan config:clear 2>/dev/null || true
php artisan cache:clear 2>/dev/null || true
php artisan route:clear 2>/dev/null || true
php artisan event:clear 2>/dev/null || true

echo "✅ TODOS los cachés eliminados"

# Verificar que views esté vacío
VIEWS_COUNT=$(find /var/www/html/storage/framework/views -type f 2>/dev/null | wc -l)
echo "📊 Archivos en views/: $VIEWS_COUNT (debe ser 0)"

# APP_KEY
if [ -z "$APP_KEY" ]; then
    echo "⚠️  Generando APP_KEY..."
    php artisan key:generate --force
fi

# Storage link
php artisan storage:link 2>/dev/null || echo "Storage link existe"

# Migraciones si está configurado
if [ "$RUN_MIGRATIONS" = "true" ]; then
    echo "🗄️  Ejecutando migraciones..."
    php artisan migrate --force || echo "Migraciones fallaron"
fi

# NUNCA CACHEAR EN RENDER FREE
echo "⚠️  RENDER FREE - MODO SIN CACHÉS"
echo "   APP_ENV: ${APP_ENV}"
echo "   APP_DEBUG: ${APP_DEBUG}"

# NO ejecutar config:cache ni route:cache ni view:cache
echo "   ✓ Config: NO CACHEADA"
echo "   ✓ Routes: NO CACHEADAS"
echo "   ✓ Views: NO CACHEADAS"

echo ""
echo "📊 Información de la aplicación:"
php artisan about || true

echo ""
echo "✅ Inicialización completada"
echo "🌐 Servidor en puerto 10000"
echo ""

# Iniciar Apache
exec apache2-foreground