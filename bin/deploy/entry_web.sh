#!/bin/bash

source "$DOCKER_ENV_BE"

echo "starting cache init jobs"
php "/var/www/$SERVER_CRON_INDEX" || echo "FAILED"
php "/var/www/$SERVER_CRON_SITEMAP" || echo "FAILED"
echo "finished jobs"
echo "starting server"
crond
/usr/local/bin/rr serve -w "/var/www/$SERVER_WORK_DIR" -c "$SERVER_RR_CONF" &
nginx -g "daemon off;"
