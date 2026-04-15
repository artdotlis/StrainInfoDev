#!/bin/bash

# SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
#
# SPDX-License-Identifier: MIT

source "$DOCKER_ENV_BE"

echo "adding cron"
echo "17  03  *   *   sun	nginx    php84 /var/www/${SERVER_CRON_INDEX}" >>"/etc/crontab"
echo "27  04  *   *   sun	nginx    php84 /var/www/${SERVER_CRON_SITEMAP}" >>"/etc/crontab"
echo "finished"
