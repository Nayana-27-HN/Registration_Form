FROM php:8.2-apache

# Install PDO sqlite and other useful extensions
RUN apt-get update && apt-get install -y libzip-dev zip unzip \
    && docker-php-ext-install pdo pdo_sqlite pdo_mysql

# Copy app files into the Apache web root
COPY . /var/www/html/

# Ensure data folder is writable by Apache
RUN mkdir -p /var/www/html/data && chown -R www-data:www-data /var/www/html/data

EXPOSE 80
CMD ["apache2-foreground"]
