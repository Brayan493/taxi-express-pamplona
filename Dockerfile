FROM php:8.2-apache

# Instala Node.js (versión 20 recomendada para Laravel 11/12)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# Instala dependencias del sistema y extensiones de PHP
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo_pgsql pgsql mbstring exif pcntl bcmath gd zip

# Instala Composer 2.x
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copia package files primero (mejor cache de Docker)
COPY package*.json ./
COPY composer.json composer.lock ./

# Instala dependencias
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts
RUN npm ci --include=dev

# Copia el resto de los archivos
COPY . /var/www/html

# Ejecuta scripts post-install de Composer
RUN composer run-script post-autoload-dump

# Compila assets con Vite
RUN npm run build

# Verifica que los assets se compilaron
RUN ls -la /var/www/html/public/build || echo "ERROR: Build directory not found"

# Configura permisos
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/public
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 755 /var/www/html/public

# Habilita módulos de Apache necesarios
RUN a2enmod rewrite headers expires deflate

# Copia configuración de Apache
COPY docker/000-default.conf /etc/apache2/sites-available/000-default.conf

EXPOSE 10000

COPY docker/docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

ENTRYPOINT ["docker-entrypoint.sh"]