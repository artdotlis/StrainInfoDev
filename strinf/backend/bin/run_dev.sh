#!/bin/bash

# SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
#
# SPDX-License-Identifier: MIT

echo "[PHP] current PID $$"

BIN_ROOT="$(dirname "$(realpath "$0")")"
ROOT="$BIN_ROOT/../../.."
source "$BIN_ROOT/../.env"
source "$ROOT/.env"
cd "$ROOT/$STRINF_BACKEND_PUBLIC" || exit 1
pkill -f "php -S"
php -S "0.0.0.0:$BACKEND_DEV_PORT" "$BACKEND_PUBLIC_INDEX" &
trap 'echo killing all php server; pkill -f "php -S"; exit' SIGTERM SIGINT EXIT
echo "[PHP] dev server $PID"
while true; do
    sleep 5
done
