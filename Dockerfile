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

# Copia SOLO los archivos de dependencias primero (para mejor cache)
COPY composer.json composer.lock ./
COPY package*.json ./

# Instala dependencias de PHP
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts

# Instala dependencias de Node
RUN npm install

# Ahora copia TODO el código fuente
COPY . /var/www/html

# Ejecuta scripts post-install de Composer
RUN composer run-script post-autoload-dump --no-interaction || true

# Compila assets con Vite - CRÍTICO: Esto genera public/build
RUN npm run build

# VERIFICACIÓN DETALLADA de los assets
RUN echo "======================================" && \
    echo "📦 VERIFICACIÓN DE BUILD" && \
    echo "======================================" && \
    ls -lah public/ && \
    echo "" && \
    echo "📁 Contenido de public/build:" && \
    ls -lah public/build/ && \
    echo "" && \
    echo "📄 manifest.json:" && \
    cat public/build/manifest.json && \
    echo "" && \
    echo "🎨 Archivos CSS:" && \
    find public/build -name "*.css" -exec ls -lh {} \; && \
    echo "" && \
    echo "⚡ Archivos JS:" && \
    find public/build -name "*.js" -exec ls -lh {} \; && \
    echo "======================================"

# Configura permisos - INCLUYENDO public/build
RUN chown -R www-data:www-data /var/www/html/storage \
    /var/www/html/bootstrap/cache \
    /var/www/html/public
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