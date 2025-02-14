<?php

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\view_model\data;

use function Safe\json_encode;

final class ParCul
{
    /**
     * @template A
     *
     * @param array<string, A> $rel_cul
     * @param array<string, A> $rel_des_cul
     * @param array<string, A> $rel_des_str
     * @param array<string, A> $pub
     * @param array<string, A> $seq
     * @param array<string, A> $cul
     * @param array<string, A> $str
     * @param array<string, A> $tax
     * @param array<string, A> $reg
     * @param array<string, A> $dep
     * @param array<string, A> $iso
     * @param array<string, A> $brc
     * @param array<string, A> $arc
     */
    public function __construct(
        private readonly array $rel_cul,
        private readonly array $rel_des_cul,
        private readonly array $rel_des_str,
        private readonly array $pub,
        private readonly array $seq,
        private readonly array $cul,
        private readonly array $str,
        private readonly array $tax,
        private readonly array $reg,
        private readonly array $dep,
        private readonly array $iso,
        private readonly array $brc,
        private readonly array $arc
    ) {
    }

    public function createJson(): string
    {
        return json_encode(array_merge_recursive(
            $this->cul,
            $this->reg,
            $this->dep,
            $this->iso,
            $this->brc,
            $this->str,
            $this->tax,
            $this->rel_cul,
            $this->rel_des_cul,
            $this->rel_des_str,
            $this->pub,
            $this->seq,
            $this->arc
        ));
    }
}
