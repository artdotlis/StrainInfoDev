<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\configs\elems;

/** @template T */
final class ConfVStat
{
    private bool $enabled;
    private string $matomo;
    private int $id;
    private string $token;

    /** @var array<string> */
    private array $ignore;

    /** @param array<string, T> $arr_arg */
    public function __construct(array $arr_arg)
    {
        $key_names = [
            'enable' => $this->setEnabled(...),
            'matomo' => $this->setMatomo(...),
            'id' => $this->setID(...),
            'token' => $this->setToken(...),
            'ignore' => $this->setIgnore(...),
        ];
        set_conf_values($arr_arg, $key_names);
    }

    /** @return array<string> */
    public function getIgnore(): array
    {
        return $this->ignore;
    }

    public function getEnabled(): bool
    {
        return $this->enabled;
    }

    public function getMatomo(): string
    {
        return $this->matomo;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    /** @param T|null $val */
    private function setEnabled($val): bool
    {
        if (is_bool($val)) {
            $this->enabled = $val;
            return true;
        }
        return false;
    }

    /** @param T|null $val */
    private function setIgnore($val): bool
    {
        if (is_array($val)) {
            foreach ($val as $ele) {
                if (!is_string($ele)) {
                    return false;
                }
            }
            /** @var array<string> $val */
            $this->ignore = $val;
            return true;
        }
        return false;
    }

    /** @param T|null $val */
    private function setID($val): bool
    {
        if (is_int($val) && $val >= 0) {
            $this->id = $val;
            return true;
        }
        return false;
    }

    /** @param T|null $val */
    private function setMatomo($val): bool
    {
        if (is_string($val)) {
            $this->matomo = $val;
            return true;
        }
        return false;
    }

    /** @param T|null $val */
    private function setToken($val): bool
    {
        if (is_string($val)) {
            $this->token = $val;
            return true;
        }
        return false;
    }
}
