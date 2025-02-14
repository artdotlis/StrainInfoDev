<?php

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\view_model\data;

use function Safe\json_encode;

final class ParStr
{
    /**
     * @template A
     *
     * @param array<string, A> $rel_cul
     * @param array<string, A> $rel_des
     * @param array<int|string, A> $cul
     * @param array<string, A> $str
     * @param array<string, A> $tax
     * @param array<string, A> $arc
     * @param array<string, A> $seq
     * @param array<string, A> $pub
     */
    public function __construct(
        private readonly array $rel_des,
        private readonly array $rel_cul,
        private readonly array $cul,
        private readonly array $str,
        private readonly array $tax,
        private readonly array $arc,
        private readonly array $seq,
        private readonly array $pub
    ) {
    }

    public function createJson(): string
    {
        return json_encode(array_merge_recursive(
            $this->str,
            $this->tax,
            $this->arc,
            $this->seq,
            $this->pub,
            $this->cul,
            $this->rel_des,
            $this->rel_cul
        ));
    }
}
