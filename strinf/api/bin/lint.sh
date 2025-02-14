#!/bin/bash

BIN_ROOT="$(dirname "$(realpath "$0")")"
ROOT="$BIN_ROOT/../../.."
source "$BIN_ROOT/../.env"

echo "lint api"

echo "lit api v1"
redocly lint --config "$ROOT/$CONFIG_REDOC" || exit 1
echo "api linted"
