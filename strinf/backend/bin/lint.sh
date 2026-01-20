#!/bin/bash

# SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
#
# SPDX-License-Identifier: MIT

BIN_ROOT="$(dirname "$(realpath "$0")")"
ROOT="$BIN_ROOT/../../.."
source "$BIN_ROOT/../.env"

echo "lint backend"
echo " --- phpstan --- "
phpstan analyze -c "$ROOT/$CONFIG_BE_PHP_STAN" "$ROOT/$STRINF_BACKEND_SRC" || exit 1
echo "backend linted"
