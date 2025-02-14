<?php

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\model\chan\index;

use straininfo\server\shared\mvvm\view\api\IndexEntity;

interface IMIntEntAdd
{
    /**
     * @param array{string, int, int} $res
     * @param callable(string): array<string> $split
     */
    public function addSIdsEnt(
        IndexEntity $typ,
        array $res,
        callable $split,
        bool $ignore_length
    ): void;

    public function flushDB(): void;
}
