# Usamos una imagen oficial de PHP con Apache
FROM php:8.2-apache

# Instalamos extensiones necesarias para Laravel
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo_mysql gd zip

# Habilitamos mod_rewrite de Apache
RUN a2enmod rewrite

# Configuramos el DocumentRoot de Apache a la carpeta public de Laravel
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Instalamos Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copiamos los archivos de la aplicación
COPY . /var/www/html

# Ajustamos permisos
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

WORKDIR /var/www/html

# Instalamos dependencias
RUN composer install --no-dev --optimize-autoloader

EXPOSE 80