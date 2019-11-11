FROM php:7.3-apache-stretch

ARG APACHE_DOCUMENT_ROOT=/var/www/project/webroot
ARG PHP_MEMORY_LIMIT=512M

ENV APACHE_DOCUMENT_ROOT=$APACHE_DOCUMENT_ROOT
ENV PHP_MEMORY_LIMIT=$PHP_MEMORY_LIMIT

ENV COMPOSER_ALLOW_SUPERUSER=1

ENV NVM_DIR=/use/local/bin/.nvm
ENV NODE_VERSION=10.16.0

# Configure apache
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-enabled/*.conf; \
    sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Install development tools as well as additional packages and do a cleanup afterwards
RUN apt-get update && apt-get install -y --no-install-recommends \
        git \
        ssh \
        zip \
        mysql-client \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        zlib1g-dev \
        libzip-dev \
        apt-utils \
        libicu-dev \
        g++ \
        libxml2-dev \
    && docker-php-ext-install -j$(nproc) iconv \
    && docker-php-ext-install soap \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd mysqli pdo pdo_mysql zip mbstring \
    && rm -rf /var/lib/apt/lists/*; \
    docker-php-ext-install opcache && docker-php-ext-enable opcache; \
    pecl install xdebug-2.7.2  && docker-php-ext-enable xdebug; \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer; \
    docker-php-source delete; \
    pecl clear-cache; \
    rm -rf \
        /usr/include/php \
        /usr/lib/php/build \
        /tmp/* \
        /root/.composer \
        /var/cache/apk/*;

# Install NVM


# Install nvm with node and npm
#RUN curl -sL https://raw.githubusercontent.com/creationix/nvm/v0.33.8/install.sh -o install_nvm.sh | bash \
#    && . $NVM_DIR/nvm.sh \
#    && nvm install $NODE_VERSION \
#    && nvm alias default $NODE_VERSION \
#    && nvm use default

#ENV NODE_PATH =$NVM_DIR/v$NODE_VERSION/lib/node_modules
#ENV PATH=$NVM_DIR/v$NODE_VERSION/bin:$PATH

# Configure environment
RUN a2enmod rewrite; \
    echo "file_uploads = On\n\
memory_limit = 64M\n\
upload_max_filesize = 64M\n\
post_max_size = 64M\n\
max_execution_time = 600\n\
memory_limit = ${PHP_MEMORY_LIMIT}" \
> /usr/local/etc/php/conf.d/drupal.ini; \
    sed -i 's/memory_limit = 128M/memory_limit = '"${PHP_MEMORY_LIMIT}"'/g' /usr/local/etc/php/php.ini-production; \
    sed -i 's/memory_limit = 128M/memory_limit = '"${PHP_MEMORY_LIMIT}"'/g' /usr/local/etc/php/php.ini-development; \
    echo "export PATH=\"/var/www/html/bin:${PATH}\"" > ~/.bashrc; \
    echo "xdebug.idekey = PHPSTORM" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.default_enable = 1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_enable = 1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_autostart = 1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_connect_back = 1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_port = 9000" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.var_display_max_depth = 10" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
   /etc/init.d/apache2 restart;


COPY ./project /var/www/project
COPY ./setup/db_imports/ /dump

WORKDIR $APACHE_DOCUMENT_ROOT
