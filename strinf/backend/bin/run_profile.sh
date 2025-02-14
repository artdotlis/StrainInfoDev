#!/bin/bash

BIN_ROOT="$(dirname "$(realpath "$0")")"
ROOT="$BIN_ROOT/../../.."
source "$BIN_ROOT/../.env"
mkdir -p "$ROOT/$PROFILE_BACKEND_INSIGHT"
phpinsights analyse -c "$ROOT/$CONFIG_BE_PHP_INSIGHT" -n "$ROOT/$STRINF_BACKEND_SRC" --format=json >"$ROOT/$PROFILE_BACKEND_INSIGHT/results.json"
phpmetrics --report-html="$ROOT/$PROFILE_BACKEND_METRICS" "$ROOT/$STRINF_BACKEND_SERVER,$ROOT/$STRINF_BACKEND_PUBLIC"
