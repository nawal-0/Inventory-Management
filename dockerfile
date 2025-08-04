FROM php:8.2-fpm

COPY composer.lock composer.json /var/www/

WORKDIR /var/www

# Install dependencies and clear cache
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    vim \
    unzip \
    git \
    curl \
    libonig-dev \
    libzip-dev \
    nodejs \
    npm


RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install extensions
RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install gd

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy existing application directory contents
COPY . /var/www

# Copy existing application directory permissions
COPY --chown=www-data:www-data . /var/www

COPY entrypoint_install.sh /usr/local/bin/entrypoint_install.sh
RUN chmod +x /usr/local/bin/entrypoint_install.sh

EXPOSE 9000

ENTRYPOINT ["/usr/local/bin/entrypoint_install.sh"]
CMD ["php-fpm"]