#!/bin/sh

# SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
#
# SPDX-License-Identifier: MIT

set -eu

[ -e /run/mysqld/mysqld.sock ] && chmod 770 /run/mysqld/mysqld.sock

CONFIG_FILE="/run/secrets/config"

if [ -f "$CONFIG_FILE" ]; then
    export MARIADB_ROOT_PASSWORD=$(jq -r '.model.database.password' "$CONFIG_FILE")
    export MARIADB_USER=$(jq -r '.model.database.user' "$CONFIG_FILE")
    export MARIADB_PASSWORD=$(jq -r '.model.database.password' "$CONFIG_FILE")
    export MARIADB_DATABASE=$(jq -r '.model.database.db' "$CONFIG_FILE")
fi

docker-entrypoint.sh mariadbd &

until mariadb-admin ping -h localhost -u root -p"${MARIADB_ROOT_PASSWORD}" > /dev/null 2>&1; do
    sleep 1
done

mariadb -h localhost -u root -p"${MARIADB_ROOT_PASSWORD}" <<EOF
SET GLOBAL innodb_compression_algorithm='zlib';
GRANT ALL PRIVILEGES ON ${MARIADB_DATABASE}.* TO '${MARIADB_USER}'@'%' IDENTIFIED BY '${MARIADB_PASSWORD}';
FLUSH PRIVILEGES;
EOF

chmod 770 /run/mysqld/mysqld.sock

sleep infinity
