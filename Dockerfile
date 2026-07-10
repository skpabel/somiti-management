# Use the official PHP image with FPM
FROM php:8.2-fpm

# Set working directory
WORKDIR /app

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nginx \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application files
COPY . /app/

# Create necessary directories with proper permissions
RUN mkdir -p bootstrap/cache \
    && mkdir -p storage/framework/sessions \
    && mkdir -p storage/framework/views \
    && mkdir -p storage/framework/cache \
    && mkdir -p storage/logs \
    && mkdir -p /var/log/nginx \
    && mkdir -p /var/cache/nginx \
    && chmod -R 775 bootstrap/cache \
    && chmod -R 775 storage

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction || composer install --no-dev --optimize-autoloader --no-interaction --ignore-platform-reqs

# Install Node.js and build assets
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && npm ci \
    && npm run build

# Set permissions
RUN chmod -R 775 /app/storage /app/bootstrap/cache

# Expose port
EXPOSE 8080

# Start application
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]
