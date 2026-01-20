#!/bin/bash

# SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
#
# SPDX-License-Identifier: MIT

eval "$1" > /dev/null 2>&1 &
PID=$!
trap 'echo killing first command - "$PID"; kill -15 "$PID"; exit' SIGINT

eval "$2"
echo "killing first command - \"$PID\""
kill -15 "$PID"
echo "normal exit reached"
