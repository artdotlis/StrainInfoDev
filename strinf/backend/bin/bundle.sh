#!/bin/bash

BIN_ROOT="$(dirname "$(realpath "$0")")"
ROOT="$BIN_ROOT/../../.."
source "$BIN_ROOT/../.env"

echo "bundle backend"

mkdir -p "$ROOT/$APP_BACKEND/"
cp -RT "$ROOT/$STRINF_BACKEND_SRC" "$ROOT/$APP_BACKEND"

PROD="false"
if [[ "$NODE_ENV" = 'production' ]]; then
    PROD="true"
fi

echo "clean configs"
find "$(dirname "$ROOT/$APP_CONFIG/")" -type f -name ".*" -delete
echo "backend production - $PROD - $ROOT/$APP_BACKEND_CONFIG"
sed -i -E "s/(const PRODUCTION\\s*=)\\s*[falstrue]+;/\\1 $PROD;/g" "$ROOT/$APP_BACKEND_CONFIG"
echo "backend bundled"
