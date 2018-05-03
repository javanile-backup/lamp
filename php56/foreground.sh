#!/bin/bash

## run cron
chmod a+x /etc/cron.d/crontab
crontab /etc/cron.d/crontab
cron

## run apache
apache2-foreground
