#!/bin/bash

echo "[PHP] current PID $$"

BIN_ROOT="$(dirname "$(realpath "$0")")"
ROOT="$BIN_ROOT/../../.."
source "$BIN_ROOT/../.env"
source "$ROOT/.env"
cd "$ROOT/$STRINF_BACKEND_PUBLIC" || exit
php -S "0.0.0.0:$BACKEND_DEV_PORT" "$BACKEND_PUBLIC_INDEX" &
PID=$!
trap 'echo killing php dev server - "$PID"; kill -9 "$PID"; exit' SIGTERM SIGINT EXIT
echo "[PHP] dev server $PID"
while true; do
    sleep 5
done
