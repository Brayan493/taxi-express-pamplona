# Etapa 1: Build de dependencias
FROM php:8.2-apache as build

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpq-dev \
    libzip-dev \
    libpng-dev \
    nodejs \
    npm \
    && rm -rf /var/lib/apt/lists/*

# Instalar extensiones de PHP necesarias
RUN docker-php-ext-install pdo pdo_pgsql zip gd

WORKDIR /app

# Copiar archivos de dependencias primero (mejor cache)
COPY composer.json composer.lock package.json package-lock.json ./

# Instalar composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

# Instalar dependencias
RUN composer install --no-dev --optimize-autoloader --no-scripts
RUN npm ci

# Copiar el resto del proyecto
COPY . .

# Construir assets
RUN npm run build

# Optimizaciones de Laravel
RUN php artisan config:cache || true
RUN php artisan route:cache || true
RUN php artisan view:cache || true

# ==========================
# Etapa final: Producción
# ==========================
FROM php:8.2-apache

# Instalar dependencias de producción
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    libpng-dev \
    && rm -rf /var/lib/apt/lists/*

# Instalar extensiones de PHP
RUN docker-php-ext-install pdo pdo_pgsql zip gd

# Habilitar módulos de Apache necesarios
RUN a2enmod rewrite headers expires

# Configurar Apache para usar variable PORT de Render
RUN sed -i 's/Listen 80/Listen ${PORT}/' /etc/apache2/ports.conf

WORKDIR /var/www/html

# Copiar aplicación desde el build
COPY --from=build /app ./

# Copiar configuración de Apache
COPY apache-config/000-default.conf /etc/apache2/sites-available/000-default.conf

# Configurar permisos
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Copiar y dar permisos al entrypoint
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# El puerto será dinámico desde la variable de entorno PORT
ENV PORT=10000

ENTRYPOINT ["docker-entrypoint.sh"]