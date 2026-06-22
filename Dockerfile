# Menggunakan image webdevops/php-apache yang sudah include semua PHP extensions
# Tidak perlu apt-get install — menghindari masalah read-only filesystem di Docker Desktop Windows
FROM webdevops/php-apache:8.2

# Mengatur DocumentRoot ke folder /public milik Laravel
ENV WEB_DOCUMENT_ROOT=/app/public
ENV PHP_DISPLAY_ERRORS=0
ENV PHP_MEMORY_LIMIT=512M

# Mengatur direktori kerja
WORKDIR /app

# Menyalin Composer dari official image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Menyalin seluruh kode aplikasi
COPY . /app

# Menyalin dan mengatur entrypoint script
COPY docker-entrypoint.sh /docker-entrypoint.sh
RUN chmod +x /docker-entrypoint.sh

# Menentukan port
EXPOSE 80

# Menggunakan entrypoint custom untuk install deps, migrate, lalu start Apache
ENTRYPOINT ["/docker-entrypoint.sh"]
