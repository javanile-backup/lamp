#!/bin/bash
## LAMP with PHP 7.2
## Author: Francesco Bianco <bianco@javanile.org>

## run cron
chmod a+x /etc/cron.d/crontab
crontab /etc/cron.d/crontab
cron

## run apache
apache2-foreground
