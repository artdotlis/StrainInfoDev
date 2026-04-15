#!/bin/bash

# SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
#
# SPDX-License-Identifier: MIT

source "$DOCKER_ENV_BE"

echo "starting cache init jobs"
php "/var/www/$SERVER_CRON_INDEX" || echo "FAILED"
php "/var/www/$SERVER_CRON_SITEMAP" || echo "FAILED"
echo "finished jobs"
echo "starting server"
crond
SERVER_RR_PHP="$SERVER_RR_PHP" BACKEND_STAGE_PORT="$BACKEND_STAGE_PORT" \
    /usr/local/bin/rr serve -w "/var/www/$SERVER_WORK_DIR" -c "$SERVER_RR_CONF" &
nginx -g "daemon off;"
