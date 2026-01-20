#!/bin/bash

# SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
#
# SPDX-License-Identifier: MIT

BIN_ROOT="$(dirname "$(realpath "$0")")"
ROOT="$BIN_ROOT/../../.."
source "$BIN_ROOT/../.env"
source "$ROOT/.env"
pkill -f "rr serve"
rr serve -w "$ROOT/$APP_BACKEND" -c "$SERVER_RR_CONF" &
trap 'echo killing all php roadrunner server; pkill -f "rr serve"; exit' SIGTERM SIGINT EXIT
echo "[PHP] roadrunner server $PID"
while true; do
    sleep 5
done
