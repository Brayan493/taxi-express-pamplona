#!/bin/bash
set -e

echo "🔧 Configurando Laravel..."

# Esperar a que PostgreSQL esté listo
echo "⏳ Esperando a PostgreSQL..."
sleep 2

# Ejecutar migraciones
php artisan migrate --force 2>&1 || echo "⚠️  Migraciones fallidas o no necesarias"

echo "✅ Migraciones ejecutadas"

# Limpiar caché
echo "🧹 Limpiando caché..."
php artisan config:clear 2>&1
php artisan cache:clear 2>&1
php artisan route:clear 2>&1
php artisan view:clear 2>&1

# Optimizar para producción
echo "⚡ Optimizando aplicación..."
php artisan config:cache 2>&1
php artisan route:cache 2>&1
php artisan view:cache 2>&1

# Configurar permisos
echo "🔐 Configurando permisos..."
chown -R www-data:www-data /var/www/html/storage
chown -R www-data:www-data /var/www/html/bootstrap/cache
chown -R www-data:www-data /var/www/html/public
chmod -R 755 /var/www/html/public

# Verificar estructura de assets
echo "📦 Verificando assets compilados..."
if [ -d "/var/www/html/public/build" ]; then
    echo "✅ Directorio /public/build encontrado"
    echo "📁 Contenido de /public/build:"
    ls -lah /var/www/html/public/build/
    
    if [ -f "/var/www/html/public/build/manifest.json" ]; then
        echo "✅ manifest.json encontrado"
        echo "📄 Contenido del manifest:"
        cat /var/www/html/public/build/manifest.json | head -n 20
    else
        echo "❌ ERROR: manifest.json NO encontrado"
    fi
    
    echo "📁 Assets CSS/JS:"
    find /var/www/html/public/build -type f \( -name "*.css" -o -name "*.js" \) -exec ls -lh {} \;
else
    echo "❌ ERROR CRÍTICO: Directorio /public/build NO existe"
    echo "📁 Contenido de /public:"
    ls -la /var/www/html/public/
fi

# Iniciar Apache
echo "🚀 Iniciando Apache en puerto 10000..."
exec apache2-foreground