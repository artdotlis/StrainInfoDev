#!/bin/bash

# SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
#
# SPDX-License-Identifier: MIT

set -euo pipefail

echo "installing deno -> $DENO_DIR"
if [ ! -d "$DENO_DIR" ]; then
    echo "installing deno"
    curl -fsSL https://deno.land/install.sh | sh -s -- -y --no-modify-path "$DENO_VER"
fi
