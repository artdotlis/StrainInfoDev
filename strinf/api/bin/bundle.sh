#!/bin/bash

BIN_ROOT="$(dirname "$(realpath "$0")")"
ROOT="$BIN_ROOT/../../.."
source "$BIN_ROOT/../.env"

EX_AONE="$ROOT/$APP_API_V1_EX"
IN_AONE="$ROOT/$APP_API_V1_IN"

EX_ATWO="$ROOT/$APP_API_V2_EX"
IN_ATWO="$ROOT/$APP_API_V2_IN"

echo "bundle api"

mkdir -p "$ROOT/$APP_API/"

echo "bundle api internal - $IN_AONE"
redocly join internal@v1 services --config "$ROOT/$CONFIG_REDOC" -o "$IN_AONE"

echo "bundle api internal - $EX_AONE"
redocly bundle external@v1 --config "$ROOT/$CONFIG_REDOC" -o "$EX_AONE"

echo "bundle api internal - $IN_ATWO"
redocly join internal@v2 services --config "$ROOT/$CONFIG_REDOC" -o "$IN_ATWO"

echo "bundle api internal - $EX_ATWO"
redocly bundle external@v2 --config "$ROOT/$CONFIG_REDOC" -o "$EX_ATWO"

echo "api bundled"
