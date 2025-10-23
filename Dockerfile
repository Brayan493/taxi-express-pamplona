# Usa PHP 8.2 con Apache
FROM php:8.2-apache

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libpq-dev \
    zip \
    unzip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalar extensiones de PHP requeridas por Laravel
RUN docker-php-ext-install \
    pdo_mysql \
    pdo_pgsql \
    pgsql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    zip

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Habilitar mod_rewrite de Apache (necesario para Laravel)
RUN a2enmod rewrite

# Establecer directorio de trabajo
WORKDIR /var/www/html

# Copiar archivos del proyecto
COPY . /var/www/html

# Instalar dependencias de Composer (sin dependencias de desarrollo)
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Los assets ya están compilados y commiteados en el repositorio
# No es necesario ejecutar npm run build

# Crear directorios de caché y darles permisos
RUN mkdir -p storage/framework/sessions \
    storage/framework/views \
    storage/framework/cache \
    storage/logs \
    bootstrap/cache

# Dar permisos a directorios críticos
RUN chown -R www-data:www-data \
    /var/www/html/storage \
    /var/www/html/bootstrap/cache

RUN chmod -R 775 \
    /var/www/html/storage \
    /var/www/html/bootstrap/cache

# Configurar Apache para que apunte a la carpeta public de Laravel
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Habilitar AllowOverride All para que funcione el .htaccess
RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# Exponer puerto (Render usa 10000 por defecto para servicios web)
EXPOSE 10000

# Script de inicio que configura el puerto dinámico, ejecuta migraciones y arranca Apache
RUN echo '#!/bin/bash\n\
set -e\n\
\n\
# Configurar el puerto de Apache según la variable PORT de Render\n\
if [ -n "$PORT" ]; then\n\
  sed -i "s/Listen 80/Listen $PORT/" /etc/apache2/ports.conf\n\
  sed -i "s/:80/:$PORT/" /etc/apache2/sites-available/000-default.conf\n\
fi\n\
\n\
# Ejecutar comandos de Laravel\n\
php artisan config:cache\n\
php artisan route:cache\n\
php artisan migrate --force\n\
\n\
# Iniciar Apache\n\
apache2-foreground' > /start.sh && chmod +x /start.sh

# Comando para iniciar
CMD ["/start.sh"]