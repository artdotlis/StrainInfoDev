<?php

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\view_model\data;

use function straininfo\server\shared\arr\arr_2_set;

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
        $res = [...$this->buf_ent];
        foreach ($this->to_buf_cul as $key => $val) {
            $res[$key] = $val;
        }
        return $res;
    }

    /** @return array<T> */
    public function getMisIds(): array
    {
        return $this->missing_id;
    }

    /** @param array<T> $mis_ids */
    public function addToMis(array $mis_ids): void
    {
        $this->missing_id = arr_2_set(  // @phpstan-ignore assign.propertyType
            [...$this->missing_id, ...$mis_ids],
            static fn ($el_v) => $el_v
        );
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
