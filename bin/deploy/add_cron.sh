#!/bin/sh

. "$DOCKER_ENV_BE"

echo "adding cron"
echo "17  03  *   *   sun	nginx    php82 /var/www/${SERVER_CRON_INDEX}" >>"/etc/crontab"
echo "27  04  *   *   sun	nginx    php82 /var/www/${SERVER_CRON_SITEMAP}" >>"/etc/crontab"
echo "finished"
