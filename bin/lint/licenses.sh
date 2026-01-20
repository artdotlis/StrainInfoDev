#!/bin/bash

# SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
#
# SPDX-License-Identifier: MIT

set -e 

ROOT="$(dirname "$(realpath "$0")")/../.."
source "$ROOT/.env"

SOFTWARE_LIC="MIT"
DATA_LIC="CC-BY-4.0"
PUB_LIC="CC0-1.0"
YEAR=$(date +%Y)

if [[ -n "$COPYRIGHT" ]]; then
    echo "COPYRIGHT is set: $COPYRIGHT"

    LICENSE_FILES=("$ROOT/LICENSE" "$ROOT/LICENSES/$SOFTWARE_LIC.txt")

    for license_file in "${LICENSE_FILES[@]}"; do
        if [[ ! -f "$license_file" ]]; then
            echo "License file $license_file does not exist"
            exit 1 
        fi
        if ! grep -q "$YEAR" "$license_file"; then
            echo "License file $license_file does not exist or COPYRIGHT not found"
            exit 1 
        fi
        if ! grep -q "$YEAR" "$license_file"; then
            echo "Current year ($YEAR) not be found in $license_file"
            exit 1
        fi
        if ! grep -q "$SOFTWARE_LIC" "$license_file"; then
            echo "License ($SOFTWARE_LIC) not be found in $license_file"
            exit 1
        fi
    done
else
    echo "COPYRIGHT is not set or is empty"
    exit 1
fi

# For javascript projects
if ! grep -q "$SOFTWARE_LIC" "$ROOT/package.json"; then
    echo "License ($SOFTWARE_LIC) not be found in package.json"
    exit 1
fi

UVX="$UV_INSTALL_DIR/uvx"

echo "INSTALLING UV"
/bin/bash "$ROOT/bin/install/uv.sh"
echo "UV INSTALLED"

FILES=()

filter_and_collect() {
    local input_file
    while IFS= read -r input_file; do
        [[ -z "$input_file" ]] && continue
        [[ "$input_file" == LICENSES/* ]] && continue
        [[ "$input_file" == "bin/lint/licenses.sh" ]] && continue
        if [[ -e "$input_file" ]]; then
            FILES+=("$input_file")
        fi
    done
}

if [ "$#" -gt 0 ]; then
    filter_and_collect < <(printf "%s\n" "$@")
else
    filter_and_collect < <(git ls-files)
fi

SOFTWARE=("sql" "toml" "Dockerfile" "conf" "template" "js" "jsx" "ts" "tsx" "html" "css" "md" "mdx" "json" "yml" "yaml" "sh" "cjs" "mjs" "txt" "php" "neon" "xml")
IMAGES=("jpg" "png" "jpeg" "ico" "webp" "avif")
CC0_FILES=(".gitignore" ".gitattributes" ".env" "bun.lock" ".dockerignore" "composer.lock")
MIT_FILES=("Makefile" "prettierignore" "shellcheckrc")
MIT_FOLDERS=(".husky")

mit_to_annotate=()
ccby_to_annotate=()
cc0_to_annotate=()

check_folder_in_array() {
    local search="$1"
    shift
    local -a container=("$@")

    for ele in "${container[@]}"; do
        if [[ "$search" == *"$ele"* ]]; then
            return 0 
        fi
    done

    return 1  
}

for file in "${FILES[@]}"; do
    extension="${file##*.}"    
    file_name=$(basename "$file")
    file_dir=$(dirname "$file")
    if check_folder_in_array "$file_dir" "${MIT_FOLDERS[@]}"; then
        mit_to_annotate+=("$file")
        continue
    fi
    if check_folder_in_array "$extension" "${SOFTWARE[@]}"; then
        mit_to_annotate+=("$file")
        continue
    fi
    if check_folder_in_array "$extension" "${IMAGES[@]}"; then
        ccby_to_annotate+=("$file")
        continue
    fi
    if check_folder_in_array "$file_name" "${MIT_FILES[@]}"; then
        mit_to_annotate+=("$file")
        continue
    fi
    if check_folder_in_array " ${file_name}" "${CC0_FILES[@]}"; then
        cc0_to_annotate+=("$file")
        continue
    fi
done

if [ ${#mit_to_annotate[@]} -gt 0 ]; then
    echo "annotating MIT"
    "$UVX" reuse annotate -c "$COPYRIGHT" -l "$SOFTWARE_LIC" -y "$YEAR" --merge-copyrights --fallback-dot-license "${mit_to_annotate[@]}"
else
    echo "No MIT files to annotate"
fi

if [ ${#ccby_to_annotate[@]} -gt 0 ]; then
    echo "annotating CC-BY"
    "$UVX" reuse annotate -c "$COPYRIGHT" -l "$DATA_LIC" -y "$YEAR" --merge-copyrights --fallback-dot-license "${ccby_to_annotate[@]}"
else
    echo "No CC-BY files to annotate"
fi

if [ ${#cc0_to_annotate[@]} -gt 0 ]; then
    echo "annotating CC0"
    "$UVX" reuse annotate -c "$COPYRIGHT" -l "$PUB_LIC" -y "$YEAR" --merge-copyrights --fallback-dot-license "${cc0_to_annotate[@]}"
else
    echo "No CC0 files to annotate"
fi

if ! "$UVX" reuse lint; then
    echo "Linting failed!"
    exit 1
fi

if ! git diff --quiet || [ -n "$(git ls-files --other --exclude-standard)" ]; then
    echo "There are uncommitted changes or untracked files in the repository."
    git ls-files --other --exclude-standard
    git diff
    exit 1
fi