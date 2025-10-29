#!/bin/bash
set -e

echo "==================================="
echo "Iniciando aplicación Laravel..."
echo "==================================="

# Esperar por la base de datos
echo "Esperando por la base de datos..."
sleep 5

# Ejecutar migraciones
echo "Ejecutando migraciones..."
php artisan migrate --force

# Limpiar y optimizar
echo "Optimizando aplicación..."
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Verificar permisos
echo "Verificando permisos..."
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Iniciar Apache
echo "==================================="
echo "Iniciando Apache en puerto ${PORT:-8080}..."
echo "==================================="
apache2-foreground