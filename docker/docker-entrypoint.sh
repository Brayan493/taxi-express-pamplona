#!/bin/bash

echo "🔧 Configurando Laravel..."

# Espera a que la base de datos esté lista (importante para PostgreSQL)
echo "⏳ Esperando a PostgreSQL..."
until php artisan migrate --force 2>/dev/null; do
    echo "Base de datos no está lista, reintentando en 2 segundos..."
    sleep 2
done

echo "✅ Migraciones ejecutadas exitosamente"

# Limpia caché
echo "🧹 Limpiando caché..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Optimiza para producción
echo "⚡ Optimizando aplicación..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Ajusta permisos
echo "🔐 Configurando permisos..."
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

echo "🚀 Iniciando Apache en puerto 10000..."
apache2-foreground