#!/bin/sh

rm -rf /socket/redis.sock
docker-entrypoint.sh /redis.conf