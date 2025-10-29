Docker: FROM php:8.2-apache

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

# Instala Composer 2.x
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copia archivos de dependencias
COPY composer.json composer.lock package*.json ./

# Instala dependencias de PHP (sin dev)
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts

# ⚡ CAMBIO CRÍTICO: Instalar TODAS las dependencias de Node (incluidas devDependencies)
# porque Vite está en devDependencies y lo necesitamos para compilar
RUN npm ci

# Copia todo el código fuente
COPY . /var/www/html

# Ejecuta scripts post-install
RUN composer run-script post-autoload-dump --no-interaction || true

# Compila assets con Vite
RUN npm run build

# 🧹 OPCIONAL: Limpia node_modules después del build para reducir tamaño de imagen
RUN rm -rf node_modules && npm ci --omit=dev

# Verificación de build
RUN echo "======================================" && \
    echo "📦 VERIFICACIÓN DE BUILD" && \
    echo "======================================" && \
    ls -lah public/ && \
    echo "" && \
    echo "📁 Contenido de public/build:" && \
    ls -lah public/build/ && \
    echo "" && \
 if [ -f "public/build/manifest.json" ]; then \
        echo "✅ manifest.json encontrado:"; \
        cat public/build/manifest.json; \
    else \
        echo "❌ manifest.json NO encontrado!"; \
        exit 1; \
    fi && \
    echo "" && \
    echo "🎨 Archivos CSS:" && \
    find public/build -name "*.css" -exec ls -lh {} \; && \
    echo "" && \
    echo "⚡ Archivos JS:" && \
    find public/build -name "*.js" -exec ls -lh {} \; && \
    echo "======================================"

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
# Configura Apache para escuchar en puerto 10000
RUN sed -i 's/Listen 80/Listen 10000/' /etc/apache2/ports.conf

EXPOSE 10000

# Copia y configura entrypoint
COPY docker/docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

ENTRYPOINT ["docker-entrypoint.sh"]