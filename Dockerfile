FROM php:8.2-apache

# Instalar extensiones necesarias
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    unzip \
    git \
    zip \
    libicu-dev \
    libonig-dev \
    libxml2-dev \
    libjpeg-dev \
    libpng-dev \
    libfreetype6-dev \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql intl zip opcache

# Activar mod_rewrite para Apache
RUN a2enmod rewrite

# Configurar Apache
COPY docker/vhost.conf /etc/apache2/sites-available/000-default.conf

# Copiar Composer desde su imagen oficial
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Establecer el directorio de trabajo
WORKDIR /var/www/html

# Copiar all the proyecto (esto asegura que composer.json ya está dentro del contenedor)
COPY . .

# Ejecutar Composer install
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Dar permisos apropiados
RUN chown -R www-data:www-data var

EXPOSE 80
