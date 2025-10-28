FROM php:8.2-apache

# Instala Node.js
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
    && docker-php-ext-install pdo_pgsql pgsql mbstring exif pcntl bcmath gd zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copia archivos de dependencias
COPY composer.json composer.lock package*.json ./

# Instala dependencias de PHP
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts

# Instala TODAS las dependencias de Node (incluyendo devDependencies para el build)
RUN npm ci

# Copia TODO el código fuente
COPY . /var/www/html

# Ejecuta scripts post-install
RUN composer run-script post-autoload-dump --no-interaction || true

# Compila assets con Vite
RUN npm run build

# VERIFICACIÓN CRÍTICA - Mostrar lo que se generó
RUN echo "========================================" && \
    echo "📦 VERIFICACIÓN DETALLADA DE BUILD" && \
    echo "========================================" && \
    echo "📁 Estructura de public/:" && \
    ls -lR public/ && \
    echo "" && \
    echo "📂 Contenido de public/build/:" && \
    ls -lah public/build/ && \
    echo "" && \
    echo "📂 Contenido de public/build/assets/:" && \
    ls -lah public/build/assets/ 2>/dev/null || echo "❌ assets/ no existe" && \
    echo "" && \
    echo "📄 Manifest.json completo:" && \
    cat public/build/manifest.json && \
    echo "" && \
    echo "========================================"

# CRÍTICO: Verificar que los archivos CSS y JS existan
RUN if [ ! -f "public/build/manifest.json" ]; then \
        echo "❌ ERROR: manifest.json NO EXISTE"; \
        exit 1; \
    fi && \
    CSS_COUNT=$(find public/build -name "*.css" | wc -l) && \
    JS_COUNT=$(find public/build -name "*.js" | wc -l) && \
    echo "✅ Archivos CSS encontrados: $CSS_COUNT" && \
    echo "✅ Archivos JS encontrados: $JS_COUNT" && \
    if [ "$CSS_COUNT" -eq 0 ]; then \
        echo "❌ ERROR: No se generaron archivos CSS"; \
        exit 1; \
    fi

# Limpiar node_modules para reducir tamaño (opcional)
RUN rm -rf node_modules

# Configura permisos
RUN chown -R www-data:www-data \
    /var/www/html/storage \
    /var/www/html/bootstrap/cache \
    /var/www/html/public && \
    chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache && \
    chmod -R 755 /var/www/html/public

# Habilita módulos de Apache
RUN a2enmod rewrite headers expires deflate

# Copia configuración de Apache
COPY docker/000-default.conf /etc/apache2/sites-available/000-default.conf

# Configura Apache
RUN sed -i 's/Listen 80/Listen 10000/' /etc/apache2/ports.conf

EXPOSE 10000

# Entrypoint
COPY docker/docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

ENTRYPOINT ["docker-entrypoint.sh"]