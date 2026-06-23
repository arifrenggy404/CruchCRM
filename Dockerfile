# Use the official PHP image with Apache and PHP 8.4
FROM php:8.4-apache

# Install system dependencies
RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    libonig-dev \
    libcurl4-openssl-dev \
    gettext \
    locales \
    && rm -rf /var/lib/apt/lists/*

# Generate locales
RUN sed -i -e 's/# id_ID.UTF-8 UTF-8/id_ID.UTF-8 UTF-8/' /etc/locale.gen \
    && sed -i -e 's/# en_US.UTF-8 UTF-8/en_US.UTF-8 UTF-8/' /etc/locale.gen \
    && locale-gen

# Set default locale environment variables
ENV LANG id_ID.UTF-8
ENV LANGUAGE id_ID:id
ENV LC_ALL id_ID.UTF-8

# Configure and install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
    pdo \
    pdo_mysql \
    mysqli \
    bcmath \
    curl \
    fileinfo \
    gd \
    gettext \
    mbstring \
    zip

# Disable other MPMs to prevent "More than one MPM loaded" error, and enable mod_rewrite
RUN a2dismod mpm_event mpm_worker || true \
    && a2enmod mpm_prefork || true \
    && a2enmod rewrite

# Configure custom php.ini settings for file uploads and memory limit
RUN echo "upload_max_filesize = 50M" > /usr/local/etc/php/conf.d/uploads.ini \
    && echo "post_max_size = 50M" >> /usr/local/etc/php/conf.d/uploads.ini \
    && echo "memory_limit = 256M" >> /usr/local/etc/php/conf.d/uploads.ini

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy the application code
COPY . /var/www/html

# Install dependencies (only production packages)
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts

# Set permissions for Apache
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Setup entrypoint script
RUN cp /var/www/html/entrypoint.sh /usr/local/bin/entrypoint.sh \
    && chmod +x /usr/local/bin/entrypoint.sh

# Expose port 80
EXPOSE 80

ENTRYPOINT ["entrypoint.sh"]
CMD ["apache2-foreground"]
