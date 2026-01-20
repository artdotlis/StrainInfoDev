<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\mvvm\view_model\chan\sea\query;

use function Safe\preg_replace;
use function straininfo\server\shared\arr\parse_ban_str;
use function straininfo\server\shared\arr\parse_str_2_arr;

/**
 * @extends QVMChanSea<string, \straininfo\server\interfaces\mvvm\model\chan\query\QMIntSeaId>
 */
final class QVMTaxName extends QVMChanSea
{
    /** @return array<string>*/
    public function parseArg(string $arg): array
    {
        $ban_chars = $this->getMChan()->getBanChars();
        $cast_arg = preg_replace(
            '/:+/',
            ':',
            preg_replace('/[^a-zA-Z0-9\\_\-\/:.,;#+\* ]+/', ':', $arg)
        );
        return parse_str_2_arr(
            $cast_arg,
            static function (string $val) use ($ban_chars): string {
                return parse_ban_str($val, $ban_chars);
            },
            2
        );
    }

    /**
     * @param array<string> $arg
     *
     * @return array<string, array<int>>
     */
    public function getResult(array $arg): array
    {
        $res = [];
        $res_id = [];
        foreach ($arg as $name) {
            $res_id[$name] = $this->getMChan()->getTaxName(
                array_filter(
                    explode(' ', $name),
                    static fn (string $val): bool => strlen(
                        preg_replace('/\s+/', '', $val)
                    ) >= 2
                )
            );
            array_push($res, ...$res_id[$name]);
        }
        return array_filter(
            $res_id,
            static fn (array $val): bool => (bool) $val
        );
    }
}
