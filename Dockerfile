FROM php:8.0-apache

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
    libonig-dev \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

RUN a2enmod rewrite
RUN sed -ri -e 's!/var/www/html!/var/www/public!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!/var/www/public!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . /var/www

RUN composer install --no-dev --optimize-autoloader

RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

RUN curl -sL https://deb.nodesource.com/setup_16.x | bash - && \
    apt-get install -y nodejs

RUN npm install && npm run build


RUN cp /var/www/.env.example /var/www/.env \
    && sed -ri -e 's!APP_NAME=Laravel!APP_NAME="CodeXchange"!g' /var/www/.env \
    && sed -ri -e 's!APP_URL=http://localhost!APP_URL=https://codexchange.my.id!g' /var/www/.env \
    && sed -ri -e 's!DB_HOST=127.0.0.1!DB_HOST=mysql_db!g' /var/www/.env \
    && sed -ri -e 's!DB_DATABASE=laravel!DB_DATABASE=codexchange!g' /var/www/.env \
    && sed -ri -e 's!DB_USERNAME=root!DB_USERNAME=cx!g' /var/www/.env \
    && sed -ri -e 's!DB_PASSWORD=!DB_PASSWORD=cx!g' /var/www/.env

RUN php artisan key:generate \
    && php artisan storage:link \
    && php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache

# EXPOSE 8001

# CMD ["apache2-foreground"]