#!/bin/bash

BIN_ROOT="$(dirname "$(realpath "$0")")"
ROOT="$BIN_ROOT/../../.."
source "$BIN_ROOT/../.env"
source "$ROOT/.env"
cd "$ROOT/$APP_BACKEND_PUBLIC" || exit 1
pkill -f "php -S"
php -S "0.0.0.0:$BACKEND_STAGE_PORT" "$BACKEND_PUBLIC_INDEX" &
trap 'echo killing all php server; pkill -f "php -S"; exit' SIGTERM SIGINT EXIT
echo "[PHP] dev server $PID"
while true; do
    sleep 5
done
