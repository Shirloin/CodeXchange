FROM php:8.0-fpm

# Set working directory
WORKDIR /app

# Copy existing application directory contents
COPY . .

# Install depedencies
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libmariadb-dev \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    libzip-dev

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

#Install Node
RUN curl -fsSL https://deb.nodesource.com/setup_14.x | bash

RUN apt-get update && apt-get install -y nodejs

# Install extensions
RUN docker-php-ext-install \
    bcmath \
    bz2 \
    calendar \
    iconv \
    intl \
    mbstring \
    opcache \
    pdo_mysql \
    zip \
	sodium

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN npm install

RUN npm run build

RUN composer update && composer install --no-dev --optimize-autoloader

# Copy .env.example to .env
RUN cp /app/.env.example /app/.env

# Modify env variable
RUN sed -ri -e 's!APP_NAME=Laravel!APP_NAME="CodeXchange"!g' /app/.env
RUN sed -ri -e 's!APP_URL=http://localhost!APP_URL=https://codexchange.my.id!g' /app/.env
RUN sed -ri -e 's!DB_HOST=127.0.0.1!DB_HOST=mysql_db!g' /app/.env
RUN sed -ri -e 's!DB_DATABASE=laravel!DB_DATABASE=codexchange!g' /app/.env
RUN sed -ri -e 's!DB_USERNAME=root!DB_USERNAME=cx!g' /app/.env
RUN sed -ri -e 's!DB_PASSWORD=!DB_PASSWORD=cx!g' /app/.env

RUN php artisan key:generate
RUN php artisan storage:link

RUN php artisan config:cache && php artisan route:cache && php artisan view:cache
