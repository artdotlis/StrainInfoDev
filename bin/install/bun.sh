#!/bin/bash

# SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
#
# SPDX-License-Identifier: MIT

echo "installing bun -> $BUN_DIR"
if [ ! -d "$BUN_DIR" ]; then
    echo "installing bun"
    curl -fsSl https://bun.sh/install | bash -s "bun-$BUN_VER"
fi
