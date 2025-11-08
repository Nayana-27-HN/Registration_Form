# Dockerfile
FROM php:8.2-apache

# Install required apt packages (sqlite dev headers, build tools, other useful libs)
RUN apt-get update \
 && apt-get install -y --no-install-recommends \
    build-essential \
    pkg-config \
    libsqlite3-dev \
    sqlite3 \
    libzip-dev \
    zip \
    unzip \
  && rm -rf /var/lib/apt/lists/*

# Install PHP extensions: PDO, PDO_SQLITE and PDO_MYSQL
RUN docker-php-ext-install pdo pdo_mysql pdo_sqlite

# Copy application files into Apache web root
COPY . /var/www/html/

# Ensure data folder exists & is writable by www-data
RUN mkdir -p /var/www/html/data && chown -R www-data:www-data /var/www/html/data

EXPOSE 80
CMD ["apache2-foreground"]
