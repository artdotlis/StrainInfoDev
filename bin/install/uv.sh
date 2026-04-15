#!/bin/bash

# SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
#
# SPDX-License-Identifier: MIT

ROOT="$(dirname "$(realpath "$0")")/../.."

set -a

source "$ROOT/package.env"
UVE="$UV_INSTALL_DIR/uv"

[[ -d "$UV_INSTALL_DIR" ]] || (curl -LsSf https://astral.sh/uv/install.sh | bash)
"$UVE" python install "$PYV" --force
rm -rf .venv
"$UVE" venv --python="$PYV" --relocatable --link-mode=copy --seed
"$UVE" pip install --upgrade pip

set +a