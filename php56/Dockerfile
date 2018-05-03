FROM php:5.6.30-apache
RUN apt-get update

## Extend PHP
RUN apt-get install -y zlib1g-dev && \
    docker-php-ext-install zip
RUN apt-get install -y libc-client-dev libkrb5-dev && \
    docker-php-ext-configure imap --with-kerberos --with-imap-ssl && \
    docker-php-ext-install imap
RUN apt-get install -y libfreetype6-dev libjpeg62-turbo-dev libpng12-dev && \
    docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ && \
    docker-php-ext-install gd
RUN apt-get install -y libmcrypt-dev && \
    docker-php-ext-install iconv mcrypt
RUN apt-get install -y libxslt-dev && \
    docker-php-ext-install xsl
RUN apt-get install -y php5-intl && \
    find /usr/lib/php5/ -name intl.so -exec mv -t "$(php -r 'echo ini_get("extension_dir");')" {} + && \
    echo "extension=intl.so" >> /usr/local/etc/php/conf.d/custom.ini
RUN docker-php-ext-install mysql mysqli pdo pdo_mysql
COPY php.ini /usr/local/etc/php/php.ini

## Crontab
RUN apt-get install -y cron rsyslog && rm -rf /etc/cron.*
COPY crontab /etc/cron.d/crontab

## Apache
RUN usermod -u 1000 www-data
RUN groupmod -g 1000 www-data
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
RUN mkdir /etc/apache2/ssl
COPY https.crt /etc/apache2/ssl/https.crt
COPY https.pem /etc/apache2/ssl/https.pem
RUN a2enmod rewrite
RUN a2enmod ssl

## Command-line utils
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php --install-dir=/usr/local/bin --filename=composer --quiet && \
    rm composer-setup.php
RUN curl -sL https://deb.nodesource.com/setup_8.x -o nodesource_setup.sh && \
    bash nodesource_setup.sh && \
    DEBIAN_FRONTEND=noninteractive apt-get install -y nodejs

## Cleanup
RUN apt-get clean && rm -rf /tmp/* /var/tmp/* && rm -rf /var/lib/apt/lists/*

## Running
COPY foreground.sh /usr/local/bin/
WORKDIR /var/www/html
CMD ["foreground.sh"]
