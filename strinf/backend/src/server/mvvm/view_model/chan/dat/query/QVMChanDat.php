<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\mvvm\view_model\chan\dat\query;

use function Safe\preg_replace;
use straininfo\server\exceptions\mvvm\view_model\KnownViewModelExc;
use straininfo\server\interfaces\mvvm\model\chan\query\QMIntDat;
use straininfo\server\interfaces\mvvm\view_model\chan\query\QVMIntDat;
use function straininfo\server\shared\arr\parse_str_2_arr;
use straininfo\server\shared\exc\KEAct;
use straininfo\server\shared\logger\LogLevE;

use straininfo\server\shared\mvvm\view_model\data\ParCul;
use straininfo\server\shared\mvvm\view_model\data\ParStr;

/**
 * @template T of ParCul|ParStr
 *
 * @implements QVMIntDat<T>
 */
abstract class QVMChanDat implements QVMIntDat
{
    /** @var QMIntDat<array<string, object>>*/
    private readonly QMIntDat $q_cul_chan;

    /**
     * @param QMIntDat<array<string, object>> $q_cul_chan
     */
    public function __construct(
        QMIntDat $q_cul_chan,
        string $char_m,
        string $char_v
    ) {
        $this->q_cul_chan = $q_cul_chan;
        if ($char_m !== $char_v) {
            throw new KnownViewModelExc(
                "Model charset {$char_m} differs from view charset {$char_v}",
                LogLevE::CRITICAL,
                KEAct::TERM
            );
        }
    }

    /** @return array<int> */
    public function parseArg(string $arg): array
    {
        return parse_str_2_arr(
            preg_replace('/[^0-9,]+/', '', $arg),
            static fn (string $val): int => (int) $val,
            1
        );
    }

    /** @param array<int, string> $res */
    public function createJson(array $res): string
    {
        $str_res = '[';
        foreach ($res as $json) {
            $str_res .= $json . ',';
        }
        if (strlen($str_res) > 1) {
            $str_res = substr($str_res, 0, -1);
        }
        return $str_res . ']';
    }

    /**
     * @param array<int, T> $res
     *
     * @return array<int, string>
     */
    public function createJsonList(array $res): array
    {
        return array_map(
            static fn (ParCul|ParStr $val): string => $val->createJson(),
            $res
        );
    }

    /** @return QMIntDat<array<string, object>> */
    protected function getMChan(): QMIntDat
    {
        return $this->q_cul_chan;
    }
}
