#!/bin/bash

echo "installing nginx dep"
apk --no-cache add php82 php82-fpm \
    php82-opcache php82-zip php82-intl \
    php82-bcmath php82-mbstring php82-simplexml php82-dom \
    php82-pdo php82-mysqlnd php82-pdo_mysql \
    php82-curl

# php82-json already pre installed
apk --no-cache add zlib gzip
# cron
apk --no-cache add cronie

mkdir /run/php-fpm -p

[[ -f /usr/bin/php ]] || ln -s /usr/bin/php82 /usr/bin/php
[[ -f /usr/bin/php-fpm ]] || ln -s /usr/sbin/php-fpm82 /usr/bin/php-fpm

echo "finished"
# increase memory size
sed -i -E "s/memory_limit\\s*=\\s*[0-9]+.*$/memory_limit=1024M/g" "/etc/php82/php.ini"
