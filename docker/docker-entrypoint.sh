#!/bin/bash
set -e

echo "==================================="
echo "Iniciando aplicación Laravel..."
echo "==================================="

# Obtener el puerto desde la variable de entorno (por defecto 10000)
PORT=${PORT:-10000}

echo "Puerto configurado: $PORT"

# Reemplazar ${PORT} en ports.conf con el valor real
sed -i "s/Listen \${PORT}/Listen $PORT/g" /etc/apache2/ports.conf
sed -i "s/Listen 80/Listen $PORT/g" /etc/apache2/ports.conf

# Reemplazar ${PORT} en el VirtualHost
sed -i "s/\:\${PORT}/:$PORT/g" /etc/apache2/sites-available/000-default.conf

echo "Esperando por la base de datos..."
sleep 5
echo "Ejecutando migraciones..."
php artisan migrate --force

echo "Optimizando aplicación..."
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Verificando permisos..."
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

echo "==================================="
echo "Iniciando Apache en puerto $PORT..."
echo "==================================="

# Iniciar Apache en foreground
apache2-foreground