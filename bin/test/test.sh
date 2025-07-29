#!/bin/bash

ROOT="$(dirname "$(realpath "$0")")/../.."
source "$ROOT/.env"
source "$ROOT/$STRINF_API_ENV"

UVX="$UV_INSTALL_DIR/uvx"

ARGS=(
    "--url=http://localhost:$BACKEND_STAGE_PORT" --output-sanitize true
    --max-examples 12 --continue-on-failure --phases "examples,coverage,fuzzing"
    --exclude-checks negative_data_rejection -w 4
    "--request-timeout=300" --suppress-health-check too_slow
)

echo "INSTALLING UV"
/bin/bash "$ROOT/bin/install/uv.sh"
echo "UV INSTALLED"

until wget -q --spider http://localhost:"$BACKEND_STAGE_PORT"; do
    echo "waiting for backend ..."
    sleep 1
done

echo "START TESTING API"
"$UVX" schemathesis run "$ROOT/$APP_API_V1_EX" "${ARGS[@]}" || exit 1
"$UVX" schemathesis run "$ROOT/$APP_API_V1_IN" "${ARGS[@]}" || exit 1
"$UVX" schemathesis run "$ROOT/$APP_API_V2_EX" "${ARGS[@]}" || exit 1
"$UVX" schemathesis run "$ROOT/$APP_API_V2_IN" "${ARGS[@]}" || exit 1

echo "TESTS FINISHED"