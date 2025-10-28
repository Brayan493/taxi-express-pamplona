FROM php:8.2-apache

# Instala Node.js 20 y dependencias
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get update && apt-get install -y \
    nodejs git curl \
    libpng-dev libonig-dev libxml2-dev libpq-dev libzip-dev \
    zip unzip \
    && docker-php-ext-install pdo_pgsql pgsql mbstring exif pcntl bcmath gd zip

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copia primero archivos de dependencias (mejor cacheo)
COPY composer.json composer.lock package*.json ./

# Instala dependencias PHP sin-dev para producción
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Instala dependencias Node (solo para compilar)
RUN npm install

# Copia el código fuente
COPY . .

# Compilar assets Vite
RUN npm run build

# Limpiar node_modules (NO se necesita en producción)
RUN rm -rf node_modules

# Permisos correctos para Laravel
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Configuración Apache
RUN a2enmod rewrite headers expires

# Puerto para Render
RUN sed -i 's/Listen 80/Listen 10000/' /etc/apache2/ports.conf

EXPOSE 10000

# Entrypoint que limpia cachés en cada deploy
COPY docker/docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["apache2-foreground"]
