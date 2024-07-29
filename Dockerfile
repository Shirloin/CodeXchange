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

RUN echo "Configuring and installing PHP extensions..."
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

RUN echo "Enabling Apache mod_rewrite and configuring Apache..."
RUN a2enmod rewrite
RUN sed -ri -e 's!/var/www/html!/var/www/public!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www!/var/www/public!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

RUN echo "Installing Composer..."
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN echo "Copying application code..."
COPY . /var/www

WORKDIR /var/www

RUN echo "Installing Node.js and npm..."
RUN curl -sL https://deb.nodesource.com/setup_16.x | bash - \
    && apt-get update \
    && apt-get install -y nodejs

RUN npm install && npm run build

RUN echo "Installing PHP dependencies..."
RUN composer install --no-dev --optimize-autoloader

RUN echo "Setting permissions..."
RUN mkdir -p /var/www/bootstrap/cache
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache /var/www/public/build
RUN chmod -R 755 /var/www/storage /var/www/bootstrap/cache /var/www/public/build

RUN echo "Running Laravel artisan commands..."
RUN php artisan key:generate\
    && php artisan storage:link \
    && php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache
    
RUN echo "Dockerfile build completed."
