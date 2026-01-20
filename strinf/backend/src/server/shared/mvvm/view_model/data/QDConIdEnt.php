<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\view_model\data;

use function Safe\array_replace;

/** @template T of int|string */
final class QDConIdEnt
{
    /** @var array<T, string>*/
    private readonly array $buf_ent;

    /** @var array<T>*/
    private array $missing_id;

    /** @var array<T, string>*/
    private array $to_buf_cul;

    /**
     * @param array<T> $mis_id
     * @param array<T, string> $buf_cul
     */
    public function __construct(array $mis_id, array $buf_cul)
    {
        $this->missing_id = $mis_id;
        $this->buf_ent = $buf_cul;
        $this->to_buf_cul = [];
    }

    /** @return array<T, string>*/
    public function getRes(): array
    {
        return array_replace($this->buf_ent, $this->to_buf_cul);
    }

    /** @return array<T> */
    public function getMisIds(): array
    {
        return $this->missing_id;
    }

    /** @param array<T> $mis_ids */
    public function addToMis(array $mis_ids): void
    {
        $this->missing_id = array_unique([...$this->missing_id, ...$mis_ids]);
    }

    /** @return array<T, string> */
    public function getToBuf(): array
    {
        return $this->to_buf_cul;
    }

    /** @param array<T, string> $to_buf */
    public function addToBuf(array $to_buf): void
    {
        foreach ($to_buf as $key => $val) {
            $this->to_buf_cul[$key] = $val;
        }
    }

    /** @return array<T, string> */
    public function getBuf(): array
    {
        return $this->buf_ent;
    }
}
