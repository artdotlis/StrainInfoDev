<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\mvvm\view_model\chan\sea\index;

use Safe\Exceptions\JsonException;
use function Safe\json_encode;
use function Safe\preg_replace;
use straininfo\server\exceptions\mvvm\view_model\KnownViewModelExc;
use straininfo\server\interfaces\mvvm\model\chan\index\IMIntEnt;
use straininfo\server\interfaces\mvvm\view_model\chan\index\InVMIntSea;

use function straininfo\server\shared\arr\parse_ban_str;
use function straininfo\server\shared\arr\parse_str_2_str;
use straininfo\server\shared\exc\KEAct;
use straininfo\server\shared\logger\LogLevE;
use function straininfo\server\shared\mvvm\view_model\struct\parser\ind\parse_sea_term;
use function straininfo\server\shared\text\clean_arg_key_w;

final class InVMTerm implements InVMIntSea
{
    private readonly IMIntEnt $sea_chan;
    private readonly int $key_len;
    private readonly string $encode;

    public function __construct(
        IMIntEnt $q_search_chan,
        int $key_len,
        string $char_m,
        string $char_v
    ) {
        $this->sea_chan = $q_search_chan;
        $this->key_len = $key_len;
        $this->encode = $char_m;
        if ($char_m !== $char_v) {
            throw new KnownViewModelExc(
                "Model charset {$char_m} differs from view charset {$char_v}",
                LogLevE::CRITICAL,
                KEAct::TERM
            );
        }
    }

    public function parseArg(string $arg): string
    {
        $ban_chars = $this->sea_chan->getBanChars();
        $cleaned = clean_arg_key_w($arg, $this->encode);
        $parsed = parse_str_2_str(
            $cleaned,
            static function (string $val) use ($ban_chars): string {
                return (string) parse_ban_str($val, $ban_chars);
            },
            $this->key_len
        );
        if ($parsed !== '') {
            return $parsed;
        }
        return preg_replace('/[^A-Za-z]+/', '', $cleaned);
    }

    /**
     * @return array{match: array<array{string,int<0, 4>,int,int}>, exact: array<array{string,int<0, 4>,int,int}>}
     */
    public function getResult(string $arg): array
    {
        return $this->sea_chan->getSIdsEnt($arg);
    }

    /**
     * @param array{match: array<array{string,int<0, 4>,int,int}>, exact: array<array{string,int<0, 4>,int,int}>} $res
     *
     * @return array{string, bool}
     */
    public function createJson(array $res): array
    {
        try {
            return [json_encode([
                'match' => array_map(
                    static fn ($val) => parse_sea_term($val),
                    $res['match']
                ),
                'exact' => array_map(
                    static fn ($val) => parse_sea_term($val),
                    $res['exact']
                ),
            ]), count($res['match']) === 0 && count($res['exact']) === 0,
            ];
        } catch (JsonException) {
            $msg = 'Could not encode index search results array as json!';
            throw new KnownViewModelExc($msg, LogLevE::CRITICAL, KEAct::TERM);
        }
    }
}
