<?php

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\controller\chan;

interface QCIntOptSea
{
    /** @return array{string, bool} */
    public function getIndSea(string $sea_key): array;
    /** @return array{string, bool} */
    public function getSeaMic(string $si_id): array;
    /** @return array{string, bool} */
    public function getSeaMicAll(int $ind): array;
}
