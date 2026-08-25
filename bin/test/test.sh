#!/bin/bash

# SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
#
# SPDX-License-Identifier: MIT

set -euo pipefail

ROOT="$(dirname "$(realpath "$0")")/../.."

ARGS=(
    "--url=http://localhost:$BACKEND_STAGE_PORT" --output-sanitize true
    --max-examples 12 --continue-on-failure --phases "examples,coverage,fuzzing"
    --exclude-checks negative_data_rejection -w 4
    "--request-timeout=300" "--max-response-time=300"
)

UV="$UV_INSTALL_DIR/uv"
uv_run() {
    "$UV_INSTALL_DIR/uv" run "$@"
}

until wget -q --spider http://localhost:"$BACKEND_STAGE_PORT"; do
    echo "waiting for backend ..."
    sleep 1
done

echo "START TESTING API"
uv_run schemathesis run "$ROOT/$APP_API_V1_EX" "${ARGS[@]}" || exit 1
uv_run schemathesis run "$ROOT/$APP_API_V1_IN" "${ARGS[@]}" || exit 1
uv_run schemathesis run "$ROOT/$APP_API_V2_EX" "${ARGS[@]}" || exit 1
uv_run schemathesis run "$ROOT/$APP_API_V2_IN" "${ARGS[@]}" || exit 1

echo "TESTS FINISHED"