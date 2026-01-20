<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\configs\elems;

/** @template T */
final class ConfMCache
{
    private int $db_name;
    private int $ex_h;
    private int $tmp_h;
    private int $limit;

    /** @param array<string, T> $arr_arg */
    public function __construct(array $arr_arg)
    {
        $key_names = [
            'db' => $this->setName(...),
            'expire_h' => $this->setExH(...),
            'tmp_h' => $this->setTmpH(...),
            'limit' => $this->setLimit(...),
        ];
        set_conf_values($arr_arg, $key_names);
    }

    public function getName(): int
    {
        return $this->db_name;
    }

    public function getExH(): int
    {
        return $this->ex_h;
    }

    public function getTmpH(): int
    {
        return $this->tmp_h;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }

    /** @param T|null $val */
    private function setName($val): bool
    {
        if (is_int($val) && $val > 0) {
            $this->db_name = $val;
            return true;
        }
        return false;
    }

    /** @param T|null $val */
    private function setExH($val): bool
    {
        if (is_int($val) && $val > 0) {
            $this->ex_h = $val;
            return true;
        }
        return false;
    }

    /** @param T|null $val */
    private function setTmpH($val): bool
    {
        if (is_int($val) && $val > 0) {
            $this->tmp_h = $val;
            return true;
        }
        return false;
    }

    /** @param T|null $val */
    private function setLimit($val): bool
    {
        if (is_int($val)) {
            $this->limit = $val;
            return true;
        }
        return false;
    }
}
