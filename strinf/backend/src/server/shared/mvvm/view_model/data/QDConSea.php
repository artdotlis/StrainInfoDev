<?php

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\view_model\data;

use function straininfo\server\shared\arr\arr_merge_2_set;

/** @template T of string|int */
final class QDConSea
{
    /** @var array<T>*/
    private readonly array $missing_sea_id;

    /** @var array<T, array<int>>*/
    private readonly array $buf_sea;

    /** @var array<T, array<int>>*/
    private array $to_buf_sea;

    /**
     * @param array<T> $mis_sea_id
     * @param array<T, array<int>> $buf_sea
     */
    public function __construct(array $mis_sea_id, array $buf_sea)
    {
        $this->missing_sea_id = $mis_sea_id;
        $this->buf_sea = $buf_sea;
        $this->to_buf_sea = [];
    }

    /** @return array<T> */
    public function getMisIds(): array
    {
        return $this->missing_sea_id;
    }

    /** @return array<T, array<int>> */
    public function getToBuf(): array
    {
        return $this->to_buf_sea;
    }

    /** @param array<T, array<int>> $to_buf */
    public function setToBuf(array $to_buf): void
    {
        $this->to_buf_sea = $to_buf;
    }

    /** @return array<T, array<int>> */
    public function getBuf(): array
    {
        return $this->buf_sea;
    }

    /** @return array<int> */
    public function getRes(): array
    {
        return arr_merge_2_set([...$this->getBuf(), ...$this->getToBuf()]);
    }
}
