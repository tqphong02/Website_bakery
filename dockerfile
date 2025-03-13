# Sử dụng PHP 7.4 làm base image
FROM php:7.4-apache

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Copy source code vào thư mục /var/www/html trên container
COPY . var/www/html/

# Cài đặt các gói phụ thuộc của ứng dụng PHP và MySQLi
RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        libzip-dev \
        unzip \
        git \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        libmcrypt-dev \
        libxml2-dev \
        zlib1g-dev \
        libicu-dev \
    && docker-php-ext-install -j$(nproc) iconv pdo_mysql mysqli zip xmlrpc soap intl \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Expose port 80
EXPOSE 80
