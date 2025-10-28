FROM php:8.2-apache

# Instalar Node.js 20 + dependencias necesarias para Laravel + PostgreSQL
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get update && apt-get install -y \
    nodejs git curl \
    libpng-dev libonig-dev libxml2-dev libpq-dev libzip-dev \
    zip unzip \
    && docker-php-ext-install pdo_pgsql pgsql mbstring exif pcntl bcmath gd zip

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copiar solo archivos de dependencias
COPY composer.json composer.lock package*.json ./

# Instalar dependencias PHP en modo producción
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Instalar dependencias de Node para compilar assets
RUN npm install

# Copiar el resto del proyecto
COPY . .

# Compilar assets con Vite
RUN npm run build

# Eliminar node_modules para producción (Render Free no las usa)
RUN rm -rf node_modules

# Permisos correctos para Laravel
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Activar módulos necesarios de Apache
RUN a2enmod rewrite headers expires

# Cambiar Apache al puerto 10000 para Render
RUN sed -i 's/Listen 80/Listen 10000/' /etc/apache2/ports.conf

# VirtualHost optimizado para Render
RUN printf '%s\n' "<VirtualHost *:10000>
    ServerName taxi-express-ywvu.onrender.com
    DocumentRoot /var/www/html/public

    <Directory /var/www/html/public>
        Options -Indexes +FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog \${APACHE_LOG_DIR}/error.log
    CustomLog \${APACHE_LOG_DIR}/access.log combined
</VirtualHost>" > /etc/apache2/sites-available/000-default.conf

# Copiar script de inicialización de Laravel
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

EXPOSE 10000

# Ejecutar script de inicio y luego Apache
ENTRYPOINT ["/usr/local/bin/docker-entrypoint.sh"]
CMD ["apache2-foreground"]
