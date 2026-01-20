#!/bin/sh

# SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
#
# SPDX-License-Identifier: MIT

chmod 770 /run/mysqld/mysqld.sock
docker-entrypoint.sh mariadbd