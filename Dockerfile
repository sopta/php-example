FROM php:8.2-fpm

# Set Environment Variables
ENV DEBIAN_FRONTEND=noninteractive

#--------------------------------------------------------------------------
# Software's Installation
#--------------------------------------------------------------------------
# Installing tools and PHP extensions using "apt", "docker-php-ext-install", and "pecl"

# Install required packages and PHP extensions
RUN set -eux; \
    apt-get update; \
    apt-get upgrade -y; \
    apt-get install -y --no-install-recommends \
            curl \
            libmemcached-dev \
            libz-dev \
            libpq-dev \
            libssl-dev \
            libmcrypt-dev \
            libonig-dev \
            libxml2-dev; \
    rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN set -eux; \
    docker-php-ext-install pdo_mysql

# Verify installed extensions
RUN php -m

# Clean up
RUN set -eux; \
    apt-get clean; \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*