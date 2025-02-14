#!/bin/bash

BIN_ROOT="$(dirname "$(realpath "$0")")/.."
ROOT="$(dirname "$(realpath "$0")")/../../.."
source "$ROOT/.env"
source "$BIN_ROOT/.env"

echo "$1"

PORT_BE=$BACKEND_DEV_PORT
PORT_FE=$FRONTEND_DEV_PORT

echo "current ports: $PORT_BE ; $PORT_FE "
if [[ "$1" = "stage" ]]; then
    PORT_BE=$BACKEND_STAGE_PORT
    PORT_FE=$FRONTEND_STAGE_PORT
    echo "ports changed: $PORT_BE ; $PORT_FE "
fi
python3 -c 'import json,sys;fr=open(sys.argv[1], "r");dat=json.load(fr);fr.close();fw=open(sys.argv[1], "w");json.dump(dat, fw);fw.close();' "$ROOT/$CONFIG_STRINF"

sed -i -E "s/(\"frontend\"\\s*:\\s*\\{[^{]*\"web\"\\s*:\\s*\\{[^{]*\"port\"\\s*:)\\s*[0-9]+/\\1 $PORT_FE/g" "$ROOT/$CONFIG_STRINF"
sed -i -E "s/(\"backend\"\\s*:\\s*\\{[^{]*\"web\"\\s*:\\s*\\{[^{]*\"port\"\\s*:)\\s*[0-9]+/\\1 $PORT_BE/g" "$ROOT/$CONFIG_STRINF"

if [[ -f "$ROOT/$APP_CONFIG" ]]; then
    python3 -c 'import json,sys;fr=open(sys.argv[1], "r");dat=json.load(fr);fr.close();fw=open(sys.argv[1], "w");json.dump(dat, fw);fw.close();' "$ROOT/$APP_CONFIG"

    sed -i -E "s/(\"frontend\"\\s*:\\s*\\{[^{]*\"web\"\\s*:\\s*\\{[^{]*\"port\"\\s*:)\\s*[0-9]+/\\1 $PORT_FE/g" "$ROOT/$APP_CONFIG"
    sed -i -E "s/(\"backend\"\\s*:\\s*\\{[^{]*\"web\"\\s*:\\s*\\{[^{]*\"port\"\\s*:)\\s*[0-9]+/\\1 $PORT_BE/g" "$ROOT/$APP_CONFIG"
fi
