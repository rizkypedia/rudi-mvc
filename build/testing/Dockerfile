FROM php:7.3-apache-stretch

MAINTAINER Sascha Hannes <hannes@publicplan.de>
MAINTAINER Maximilian Schmitz <schmitz@publicplan.de>

ENV COMPOSER_ALLOW_SUPERUSER=1

RUN apt-get update && apt-get install -y --no-install-recommends \
        unzip \
        git \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        zlib1g-dev \
        libzip-dev \
        apt-utils \
        gnupg2 \
        apt-transport-https \
        ca-certificates \
    && docker-php-ext-install -j$(nproc) iconv \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd mysqli pdo pdo_mysql zip \
    && rm -rf /var/lib/apt/lists/*

RUN curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add - \
  && curl -sL https://deb.nodesource.com/setup_12.x | bash - \
  && echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list \
  && apt-get update \
  && apt-get install -y nodejs yarn

RUN curl https://raw.githubusercontent.com/composer/getcomposer.org/76a7060ccb93902cd7576b67264ad91c8a2700e2/web/installer | php -- --install-dir=/usr/local/bin --filename=composer
COPY ./build/testing/composer.json /composer.json
RUN /usr/local/bin/composer global install -vvv -d /

COPY ./project /var/www/project

RUN cd /var/www/project && composer install
RUN yarn --cwd /var/www/project/docroot/modules/custom/vergabenrw_advanced_search install
RUN rm -rf /root/.composer \
           /var/cache/apk/*;

WORKDIR /var/www/project
