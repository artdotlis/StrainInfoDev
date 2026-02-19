#!/bin/bash

# SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
#
# SPDX-License-Identifier: MIT

CUR_DIR=$(dirname "$(realpath "$0")")
source "$CUR_DIR/../../.env"

echo "prep setup"
dnf clean all && rm -rf /var/cache/dnf
update-ca-trust extract
dnf upgrade -y
dnf -y install epel-release
dnf -y install dnf-plugins-core
dnf config-manager --set-enabled crb
dnf upgrade --refresh -y
echo -e "copy health"
cp "$CUR_DIR/health.sh" / && chmod +x /health.sh
echo -e "copy entrypoint"
cp "$CUR_DIR/entry_dev.sh" / && chmod +x /entry_dev.sh

mkdir -p "$DOCKER_ENV_DIR"
cp "$CUR_DIR/entry_web.sh" "/entry.sh"
cp "$STRINF_BACKEND_ENV" "$DOCKER_ENV_BE"

echo "prep finished"
