#!/bin/bash

BIN_ROOT="$(dirname "$(realpath "$0")")"
ROOT="$BIN_ROOT/../../.."
source "$BIN_ROOT/../.env"

echo "lint backend"
echo " --- phpinsights --- "
phpinsights analyse -c "$ROOT/$CONFIG_BE_PHP_INSIGHT" --fix -n "$1" || exit 1
echo " --- phpstan --- "
phpstan analyze -c "$ROOT/$CONFIG_BE_PHP_STAN" "$1" || exit 1
echo " --- phpcbf --- "
sh "$ROOT/$BIN_RUN_SH" phpcbf --standard="$ROOT/$CONFIG_BE_PHP_CS" -p "$1"
echo " --- phpcs --- "
phpcs --extensions=php,inc,lib,module,info --standard="$ROOT/$CONFIG_BE_PHP_CS" "$1" || exit 1
echo "backend linted"
