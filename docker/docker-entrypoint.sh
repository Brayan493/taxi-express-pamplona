#!/bin/bash
set -e

echo "🚀 Iniciando aplicación Laravel en Render..."

cd /var/www/html

# ✅ Asegurar estructura del storage
mkdir -p storage/framework/{cache,data,sessions,views}

# ✅ Permisos correctos
echo "🔐 Configurando permisos..."
chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

# ✅ Crear enlaces de storage
if [ ! -L "public/storage" ]; then
    echo "🔗 Creando storage link..."
    php artisan storage:link || true
fi

# ✅ Limpiar cachés básicos
echo "💣 Limpiando cachés..."
php artisan optimize:clear || true

# ✅ APP_KEY si falta
if ! grep -q "APP_KEY=base64:" /var/www/html/.env 2>/dev/null; then
    echo "⚠️ Generando APP_KEY..."
    php artisan key:generate --force || true
fi

# ✅ Migraciones opcionales
if [ "${RUN_MIGRATIONS}" = "true" ]; then
    echo "🗄️ Ejecutando migraciones..."
    php artisan migrate --force || echo "⚠️ Migraciones fallaron"
fi

echo "⚠️ Render Free: Cachés desactivados"
echo "   ✓ Config"
echo "   ✓ Rutas"
echo "   ✓ Views"

echo ""
echo "📊 Estado de la aplicación:"
php artisan about || true

echo ""
echo "✅ Inicialización
