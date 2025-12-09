#!/bin/bash

BIN_ROOT="$(dirname "$(realpath "$0")")"
ROOT="$BIN_ROOT/../../.."
source "$BIN_ROOT/../.env"
phpmetrics --report-html="$ROOT/$PROFILE_BACKEND_METRICS" "$ROOT/$STRINF_BACKEND_SERVER,$ROOT/$STRINF_BACKEND_PUBLIC"
