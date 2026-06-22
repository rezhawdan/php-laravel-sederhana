# Menggunakan image PHP 8.2 dengan Apache
FROM php:8.2-apache

# Mengatur environment variable untuk Apache DocumentRoot
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

# Mengubah konfigurasi Apache untuk mengarahkan root ke direktori /public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Mengaktifkan modul rewrite Apache untuk Laravel routing
RUN a2enmod rewrite

# Menginstal dependensi sistem dan ekstensi PHP yang dibutuhkan Laravel
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql gd zip bcmath \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Menyalin Composer dari official image Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Mengatur direktori kerja
WORKDIR /var/www/html

# Menyalin seluruh kode aplikasi Laravel ke dalam container
COPY . /var/www/html

# Menginstal dependensi Composer (package PHP)
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Mengatur hak akses kepemilikan untuk folder storage dan bootstrap/cache agar apache bisa menulis log/cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Menentukan port yang digunakan container
EXPOSE 80

# Jalankan server Apache di foreground
CMD ["apache2-foreground"]
