#!/bin/bash

BIN_ROOT="$(dirname "$(realpath "$0")")"
ROOT="$BIN_ROOT/../../.."
source "$BIN_ROOT/../.env"
source "$ROOT/.env"

cd "$ROOT/$APP_BACKEND_PUBLIC" && php -S "0.0.0.0:$BACKEND_STAGE_PORT" "$BACKEND_PUBLIC_INDEX"
