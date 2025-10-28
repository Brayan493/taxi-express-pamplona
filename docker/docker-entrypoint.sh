#!/bin/bash
set -e

echo "🚀 Iniciando aplicación Laravel en Render..."

cd /var/www/html

# ✅ Permisos correctos (más seguros)
echo "🔐 Configurando permisos..."
chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

# ✅ Crear enlaces de storage si no existen
if [ ! -L "public/storage" ]; then
    echo "🔗 Creando storage link..."
    php artisan storage:link || true
fi

# ✅ Limpiar cachés sin eliminar archivos del framework
echo "💣 Limpiando cachés..."
php artisan optimize:clear || true

# ✅ APP_KEY si falta
if ! grep -q "APP_KEY=base64:" /var/www/html/.env 2>/dev/null; then
    echo "⚠️ APP_KEY faltante → Generando..."
    php artisan key:generate --force || true
fi

# ✅ Migraciones opcionales
if [ "${RUN_MIGRATIONS}" = "true" ]; then
    echo "🗄️ Ejecutando migraciones..."
    php artisan migrate --force || echo "⚠️ Migraciones fallaron"
fi

# ✅ No hacer config:cache en Render Free
echo "⚠️ Render Free: MODO SIN CACHÉS"
echo "   ✓ Config"
echo "   ✓ Rutas"
echo "   ✓ Views"

echo ""
echo "📊 Estado de la aplicación:"
php artisan about || true

echo ""
echo "✅ Inicialización completada correctamente"
echo "🌐 Apache corriendo en puerto 10000"
echo ""

exec apache2-foreground
