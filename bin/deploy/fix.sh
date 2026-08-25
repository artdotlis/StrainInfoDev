#!/bin/bash

# SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
#
# SPDX-License-Identifier: MIT

set -euo pipefail

ROOT="$(dirname "$(realpath "$0")")/../.."

echo "prepare for packaging"

mkdir -p "$(dirname "$ROOT/$CONFIG_STRINF")"

echo "$CONFIG_DEPLOY_STYLE"
echo "$CONFIG_DEPLOY_ASSETS"

echo "fetching custom style - currently digidive"
mkdir -p "$ROOT/$EXTRA_STYLE"
if [ -z "$(ls -A "$ROOT/$EXTRA_STYLE")" ]; then
    if [ -z "$CONFIG_DEPLOY_STYLE" ]; then
        echo "Error: IN_STYLE URL is empty! Check $CONFIG_DEPLOY." >&2
        exit 1
    fi
    if [[ "$CONFIG_DEPLOY_STYLE" != *"$EX_STYLE_VER"* ]]; then
        echo "Error: STYLE URL does not match version '$EX_STYLE_VER'." >&2
        exit 1
    fi
    rm -rf /tmp/style_container /tmp/style

    if wget -q -O /tmp/style_container "$CONFIG_DEPLOY_STYLE" && [ -s /tmp/style_container ]; then
        mkdir -p /tmp/style
        unzip -q /tmp/style_container -d /tmp/style

        if [ -d "/tmp/style/dist" ]; then
            mv /tmp/style/dist/* "$ROOT/$EXTRA_STYLE/"
        else
            echo "Error: /tmp/style/dist not found"
            exit 1
        fi
        sed -i -E 's/fill:%23006eb7/fill:%23ECAF00/g' "$ROOT/$EXTRA_STYLE/css/digidive.css"
        sed -i -E "s/(font-family\\s*:\\s*['\"].*['\"]\\s*;)/\\1\\n\\tfont-display: swap;/g" "$ROOT/$EXTRA_STYLE/css/digidive.css"
        sed -i -E 's/max-width:\s*var\(150rem\);//g' "$ROOT/$EXTRA_STYLE/css/digidive.css"
        sed -i -E 's/format\("truetype"\)/format\("woff2"\)/g' "$ROOT/$EXTRA_STYLE/css/digidive.css"
        sed -i -E 's/\.otf/\.woff2/g' "$ROOT/$EXTRA_STYLE/css/digidive.css"
        sed -i -E 's/\.ttf/\.woff2/g' "$ROOT/$EXTRA_STYLE/css/digidive.css"
        echo "window.style = digidive;" >>"$ROOT/$EXTRA_STYLE/js/digidive.js"
        find "$ROOT/$EXTRA_STYLE/css/" -name "*.ttf" -exec woff2_compress {} \;
        find "$ROOT/$EXTRA_STYLE/css/" -name "*.otf" -exec woff2_compress {} \;
    else
        echo "Error: could not download style"
        exit 1
    fi

fi

echo "{\"name\": \"digidive\",\"private\": true,\"author\": \"Julia Koblitz\",\"license\": \"MIT\",\"version\": \"$EX_STYLE_VER\",\"main\": \"js/digidive.js\"}" >"$ROOT/$EXTRA_STYLE/package.json"
mkdir -p "$ROOT/$EXTRA_STYLE/js"
cp "$ROOT/strinf/patch/style.d.ts" "$ROOT/$EXTRA_STYLE/js/digidive.d.ts"

echo "fetching logos"
mkdir -p "$ROOT/$EXTRA_ASSETS"
if [ -z "$(ls -A "$ROOT/$EXTRA_ASSETS")" ]; then
    if [ -z "$CONFIG_DEPLOY_ASSETS" ]; then
        echo "Error: ASSETS URL is empty! Check $CONFIG_DEPLOY." >&2
        exit 1
    fi
    ARCHIVE_PATH="${ROOT:?}/$EXTRA_ASSETS/out.tar.gz"
    if wget -q -O "$ARCHIVE_PATH" "$CONFIG_DEPLOY_ASSETS" && [ -s "$ARCHIVE_PATH" ]; then
        tar -xvzf "$ARCHIVE_PATH" --directory "$ROOT/$EXTRA_ASSETS/"
        
        if [ -d "$ROOT/$EXTRA_ASSETS/strinfassets-main/straininfo/" ]; then
            mv "$ROOT/$EXTRA_ASSETS/strinfassets-main/straininfo/"* "$ROOT/$EXTRA_ASSETS/"
        else
            echo "Error: assets not found"
            exit 1
        fi
        
        rm -rf "${ROOT:?}/$EXTRA_ASSETS/strinfassets-main"
        rm -f "$ARCHIVE_PATH"
    else
        echo "Error: Failed to download assets tarball or file is empty." >&2
        rm -f "$ARCHIVE_PATH"
        exit 1
    fi
fi

echo "{\"name\": \"@extra/straininfo\",\"private\": true,\"license\": \"Proprietary\",\"author\": \"Artur Lissin\",\"version\": \"0.0.0\"}" >"$ROOT/$EXTRA_ASSETS/package.json"

echo "preparation finished"
