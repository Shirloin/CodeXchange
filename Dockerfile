# Menggunakan image PHP dengan FPM
FROM php:8.0-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy existing application directory contents
COPY . /var/www

# Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# Install Node.js and NPM
RUN curl -sL https://deb.nodesource.com/setup_16.x | bash - && \
    apt-get install -y nodejs

# Install Vite and dependencies
RUN npm install && npm run build

# Copy .env.example to .env and modify environment variables
RUN cp /var/www/.env.example /var/www/.env \
    && sed -ri -e 's!APP_NAME=Laravel!APP_NAME="CodeXchange"!g' /var/www/.env \
    && sed -ri -e 's!APP_URL=http://localhost!APP_URL=https://codexchange.my.id!g' /var/www/.env \
    && sed -ri -e 's!DB_HOST=127.0.0.1!DB_HOST=mysql_db!g' /var/www/.env \
    && sed -ri -e 's!DB_DATABASE=laravel!DB_DATABASE=codexchange!g' /var/www/.env \
    && sed -ri -e 's!DB_USERNAME=root!DB_USERNAME=cx!g' /var/www/.env \
    && sed -ri -e 's!DB_PASSWORD=!DB_PASSWORD=cx!g' /var/www/.env

# Generate Laravel key and setup storage link
RUN php artisan key:generate \
    && php artisan storage:link \
    && php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache

# Expose port 9000 for PHP-FPM
EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm"]
