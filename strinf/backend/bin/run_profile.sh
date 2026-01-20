#!/bin/bash

# SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
#
# SPDX-License-Identifier: MIT

BIN_ROOT="$(dirname "$(realpath "$0")")"
ROOT="$BIN_ROOT/../../.."
source "$BIN_ROOT/../.env"
phpmetrics --report-html="$ROOT/$PROFILE_BACKEND_METRICS" "$ROOT/$STRINF_BACKEND_SERVER,$ROOT/$STRINF_BACKEND_PUBLIC"
