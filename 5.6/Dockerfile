## LAMP with PHP 5.6
FROM php:5.6.30-apache
LABEL MAINTAINER="Francesco Bianco <info@javanile.org>"
WORKDIR /var/www/html

## Environment
ENV HTML_PUBLIC=
ENV PHP_MEMORY_LIMIT=32M

## Extend PHP
RUN apt-get update \
 ## Zip extension
 && apt-get install -y --no-install-recommends zlib1g-dev \
 && docker-php-ext-install zip \
 ## Imap extension
 && apt-get install -y --no-install-recommends libc-client-dev libkrb5-dev \
 && docker-php-ext-configure imap --with-kerberos --with-imap-ssl \
 && docker-php-ext-install imap \
 ## Gd extension
 && apt-get install -y --no-install-recommends libfreetype6-dev libjpeg62-turbo-dev libpng12-dev \
 && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
 && docker-php-ext-install gd \
 ## Mcrypt extension
 && apt-get install -y --no-install-recommends libmcrypt-dev \
 && docker-php-ext-install iconv mcrypt \
 ## Xsl extension
 && apt-get install -y --no-install-recommends libxslt-dev \
 && docker-php-ext-install xsl \
 ## Intl extension
 && apt-get install -y --no-install-recommends php5-intl \
 && find /usr/lib/php5/ -name intl.so -exec mv -t "$(php -r 'echo ini_get("extension_dir");')" {} + \
 && echo "extension=intl.so" >> /usr/local/etc/php/conf.d/custom.ini \
 ## Other extensions
 && docker-php-ext-install mysql mysqli pdo pdo_mysql sockets \
 ## Clean-up layer
 && rm -rf /var/lib/apt/lists/*
COPY php.ini /usr/local/etc/php/php.ini

## Crontab
RUN apt-get update \
 && apt-get install -y --no-install-recommends cron rsyslog \
 && rm -rf /etc/cron.* /var/lib/apt/lists/*
COPY crontab /etc/cron.d/crontab

## Apache
RUN usermod -u 1000 www-data && groupmod -g 1000 www-data \
 && echo "ServerName localhost" >> /etc/apache2/apache2.conf \
 && mkdir /etc/apache2/ssl
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf
COPY ssl/localhost.crt /etc/apache2/ssl/localhost.crt
COPY ssl/localhost.pem /etc/apache2/ssl/localhost.pem
RUN a2enmod rewrite && a2enmod ssl

## Command-line utils
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
 && php composer-setup.php --install-dir=/usr/local/bin --filename=composer --quiet \
 && rm composer-setup.php
RUN curl -sL https://deb.nodesource.com/setup_8.x -o nodesource_setup.sh \
 && bash nodesource_setup.sh && apt-get install -y --no-install-recommends nodejs \
 && rm -rf /var/lib/apt/lists/*

## Clean-up
RUN apt-get clean && rm -rf /tmp/* /var/tmp/* && rm -rf /var/lib/apt/lists/*

## Running
COPY foreground.sh /usr/local/bin/
CMD ["foreground.sh"]
