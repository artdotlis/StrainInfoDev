#!/bin/bash

BIN_ROOT="$(dirname "$(realpath "$0")")/.."
ROOT="$BIN_ROOT/../.."
source "$BIN_ROOT/.env"

echo "starting cron jobs"
php "$ROOT/$STRINF_CRON_INDEX"
mkdir -p "$ROOT/$APP_BACKEND_PUBLIC"
php "$ROOT/$STRINF_CRON_SITEMAP" "$ROOT/$APP_BACKEND_PUBLIC"
echo "finished jobs"
