#!/bin/bash

# SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
#
# SPDX-License-Identifier: MIT

ROOT="$(dirname "$(realpath "$0")")/../.."
source "$ROOT/package.env"

echo "update"
dnf -y update
echo "installing requirements"
dnf -y --allowerasing install zlib gzip vim git git-lfs make gcc-c++ findutils wget unzip procps-ng jq curl
echo "requirements installed"
echo "install php"
dnf -y install https://rpms.remirepo.net/enterprise/remi-release-10.rpm && dnf -y update
dnf -y remove php
dnf -y remove php*
dnf -y install php85-php-cli php85-php-common 
# extensions
dnf -y install php85-php-opcache php85-php-zip php85-php-intl php85-php-pecl-msgpack php85-php-pecl-igbinary \
    php85-php-bcmath php85-php-json php85-php-mbstring php85-php-simplexml php85-php-dom \
    php85-php-pdo php85-php-mysqlnd php85-php-pdo_mysql php85-php-curl php85-php-ctype php85-php-redis
echo "php installed"
# php alias
alternatives --install /usr/bin/php php /usr/bin/php85 84
alternatives --set php /usr/bin/php85
# for woff2
mkdir /woff_parser && cd /woff_parser || exit
git clone --recursive https://github.com/google/woff2.git
cd woff2 || exit
make clean all
ln -s /woff_parser/woff2/woff2_compress /bin/woff2_compress
# increase memory size
sed -i -E "s/memory_limit\\s*=\\s*[0-9]+.*$/memory_limit=1024M/g" "/etc/opt/remi/php85/php.ini"
# for shellcheck
dnf -y install ShellCheck
