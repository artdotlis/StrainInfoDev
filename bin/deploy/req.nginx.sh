#!/bin/bash

# SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
#
# SPDX-License-Identifier: MIT

echo "installing nginx dep"
apk --no-cache add php85 \
    php85-opcache php85-zip php85-intl \
    php85-bcmath php85-mbstring php85-simplexml php85-dom \
    php85-pdo php85-mysqlnd php85-pdo_mysql \
    php85-curl php85-ctype php85-pecl-redis

# php85-json already pre installed
apk --no-cache add zlib gzip curl
# cron
apk --no-cache add cronie

[[ -f /usr/bin/php ]] || ln -s /usr/bin/php85 /usr/bin/php

echo "finished"
# increase memory size
sed -i -E "s/memory_limit\\s*=\\s*[0-9]+.*$/memory_limit=1024M/g" "/etc/php85/php.ini"
