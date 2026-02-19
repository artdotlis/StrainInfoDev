#!/bin/bash

# SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
#
# SPDX-License-Identifier: MIT

ROOT="$(dirname "$(realpath "$0")")/../.."
source "$ROOT/.env"

echo "update"
dnf -y update
echo "installing requirements"
dnf -y --allowerasing install zlib gzip vim git git-lfs make gcc-c++ findutils wget unzip procps-ng jq curl
echo "requirements installed"
echo "install php"
dnf -y install https://rpms.remirepo.net/enterprise/remi-release-10.rpm && dnf -y update
dnf -y remove php
dnf -y remove php*
dnf -y install php84-php-cli php84-php-common 
# extensions
dnf -y install php84-php-opcache php84-php-zip php84-php-intl php84-php-pecl-msgpack php84-php-pecl-igbinary \
    php84-php-bcmath php84-php-json php84-php-mbstring php84-php-simplexml php84-php-dom \
    php84-php-pdo php84-php-mysqlnd php84-php-pdo_mysql php84-php-curl php84-php-ctype php84-php-redis
echo "php installed"
# php alias
alternatives --install /usr/bin/php php /usr/bin/php84 84
alternatives --set php /usr/bin/php84
# for woff2
mkdir /woff_parser && cd /woff_parser || exit
git clone --recursive https://github.com/google/woff2.git
cd woff2 || exit
make clean all
ln -s /woff_parser/woff2/woff2_compress /bin/woff2_compress
# increase memory size
sed -i -E "s/memory_limit\\s*=\\s*[0-9]+.*$/memory_limit=1024M/g" "/etc/opt/remi/php84/php.ini"
# for shellcheck
dnf -y install ShellCheck
