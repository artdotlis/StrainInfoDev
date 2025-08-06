<?php

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\view_model\data;


/** @template T of string|int */
final class QDConSea
{
    /** @var array<T>*/
    private readonly array $missing_sea_id;

    /** @var array<T, string>*/
    private readonly array $buf_sea;

    /** @var array<T, array<int>>*/
    private array $to_buf_sea;

    /**
     * @param array<T> $mis_sea_id
     * @param array<T, string> $buf_sea
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

    /** @return array<T, string> */
    public function getBuf(): array
    {
        return $this->buf_sea;
    }

    public function getRes(): string
    {
        if (count($this->getToBuf()) === 0 && count($this->getBuf()) === 1) {
            return current($this->getBuf());
        }
        $res = [];
        foreach($this->getBuf() as $val_str) {
            foreach(explode(",", $val_str) as $val) {
                $res[$val] = true;
            }
        }
        foreach($this->getToBuf() as $val_arr) {
            foreach($val_arr as $val) {
                $res[(string) $val] = true;
            }
        }
        return implode(",", \array_keys($res));
    }
}
