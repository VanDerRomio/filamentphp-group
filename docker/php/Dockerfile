FROM php:8.2-fpm

WORKDIR /var/www

# Install dependencies
RUN apt-get update && apt-get install -y \
    g++ \
    git \
    curl \
    imagemagick \
    librabbitmq-dev \
    libssh-dev \
    libcurl3-dev \
    libicu-dev \
    libfreetype6-dev \
    libjpeg-dev \
    libjpeg62-turbo-dev \
    libonig-dev \
    libmagickwand-dev \
    libpq-dev \
    libpng-dev \
    libxml2-dev \
    libzip-dev \
    zlib1g-dev \
    default-mysql-client \
    openssh-client \
    nano \
    unzip \
    libcurl4-openssl-dev \
    libssl-dev \
    libmcrypt-dev \
    libkrb5-dev \
    libc-client-dev \
    --no-install-recommends

# clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-configure bcmath

# Install extensions
RUN docker-php-ext-install \
    soap \
    zip \
    curl \
    bcmath \
    exif \
    gd \
    iconv \
    intl \
    mbstring \
    opcache \
    pdo_mysql \
    sockets \
    pdo_pgsql

RUN PHP_OPENSSL=yes docker-php-ext-configure imap --with-kerberos --with-imap-ssl; \
    docker-php-ext-install imap;

# Install PECL extensions
# see http://stackoverflow.com/a/8154466/291573) for usage of `printf`
RUN printf "\n" | pecl install \
        imagick \
        xdebug \
        amqp \
        mcrypt-1.0.3 \
        mongodb && \
    docker-php-ext-enable \
        imagick \
        mongodb

# Environment settings
ENV COMPOSER_ALLOW_SUPERUSER=1 \
    PHP_USER_ID=33 \
    PHP_ENABLE_XDEBUG=0 \
    PATH=/app:/app/vendor/bin:/root/.composer/vendor/bin:$PATH \
    TERM=linux

COPY --from=composer /usr/bin/composer /usr/bin/composer

# Add GITHUB_API_TOKEN support for composer
# TODO: Extract token to .env file
RUN chmod 700 /usr/bin/composer

RUN composer self-update

# Enable mod_rewrite for images with apache
RUN if command -v a2enmod >/dev/null 2>&1; then \
        a2enmod rewrite headers \
    ;fi

COPY --chown=1000:1000 . /var/www

# expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
