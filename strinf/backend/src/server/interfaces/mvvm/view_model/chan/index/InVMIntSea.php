<?php

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\view_model\chan\index;

interface InVMIntSea
{
    /**
     * @return array{match: array<array{string,int<0, 4>,int,int}>, exact: array<array{string,int,int,int}>}
     */
    public function getResult(string $arg): array;

    public function parseArg(string $arg): string;

    /**
     * @param array{match: array<array{string,int<0, 4>,int,int}>, exact: array<array{string,int,int,int}>} $res
     *
     * @return array{string, bool}
     */
    public function createJson(array $res): array;
}
