#!/bin/sh

chmod 770 /run/mysqld/mysqld.sock
docker-entrypoint.sh mariadbd