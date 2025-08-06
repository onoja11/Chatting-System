# Use official PHP 8.2 FPM image
FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www

# Install system dependencies & PHP extensions
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip unzip \
    curl \
    git \
    sqlite3 \
    libsqlite3-dev \
    nodejs \
    npm \
    && docker-php-ext-install pdo pdo_sqlite mbstring exif pcntl bcmath gd

# Install Composer from official image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy all project files to container
COPY . .

# Create persistent directory for SQLite database
# Render allows persistence in /var
RUN mkdir -p /var && touch /var/database.sqlite



# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Build frontend assets
RUN npm install && npm run build

# Set file permissions for Laravel
RUN chmod -R 755 storage bootstrap/cache

# Expose port for Render
EXPOSE 8000

# Run necessary Laravel commands and start the app
CMD php artisan migrate --force && \
    php artisan config:cache && \
    php artisan db:seed && \
    php artisan route:cache && \
    php artisan view:cache && \
    php artisan serve --host=0.0.0.0 --port=8000
