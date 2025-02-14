<?php

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\view\chan;

interface QVIntOptSea
{
    /** @return array{string, bool} */
    public function getIndexKey(string $ind_key): array;

    /** @return array{string, bool} */
    public function getSeaMicAll(int $ind): array;

    /** @return array{string, bool} */
    public function getSeaMic(string $si_id): array;
}
