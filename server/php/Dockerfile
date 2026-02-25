# Base PHP image
FROM php:8.2-cli

# Set working directory
WORKDIR /app

# Install system dependencies and PHP extensions
RUN set -eux; \
    apt-get update; \
    apt-get install -y --no-install-recommends \
        git unzip zip libzip-dev $PHPIZE_DEPS ca-certificates; \
    docker-php-ext-install zip pcntl; \
    update-ca-certificates; \
    rm -rf /var/lib/apt/lists/*

# Copy Composer from official image
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy application code
COPY . /app

# Default command: run PHP built-in server
CMD ["php", "-S", "0.0.0.0:3000", "-t", "public"]
