#!/bin/bash

echo "installing composer -> $COM_BIN"
if [ ! -f "$COM_BIN" ]; then
    echo "installing composer"
    wget "https://github.com/composer/composer/releases/download/$COMPOSER_VER/composer.phar"
    SHA=$(sha384sum composer.phar | cut -f 1 -d " ")
    if [ "$SHA" = "$COMPOSER_SHA" ]; then
        echo "SHA384SUM is correct"
        mv composer.phar "$COM_BIN"
        chmod +x "$COM_BIN"
    else
        echo "SHA384SUM is incorrect"
        echo "expected $COMPOSER_SHA"
        echo "got $SHA"
        exit 1
    fi
fi
