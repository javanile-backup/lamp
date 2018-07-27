#!/bin/bash
## LAMP with PHP 7.1
## Author: Francesco Bianco <bianco@javanile.org>

## prepare log files
touch /log/php_error.log \
      /log/apache2_error.log \
      /log/apache2_access.log
chown www-data:www-data -R /log/*.log

## run cron
chmod a+x /etc/cron.d/crontab
crontab /etc/cron.d/crontab
cron

## run apache
apache2-foreground
