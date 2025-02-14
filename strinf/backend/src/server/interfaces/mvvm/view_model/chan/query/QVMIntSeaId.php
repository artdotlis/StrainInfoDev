<?php

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\view_model\chan\query;

/** @template T of string|int */
interface QVMIntSeaId
{
    /**
     * @param array<T> $arg
     *
     * @return array<T, array<int>>
     */
    public function getResult(array $arg): array;

    /** @return array<T> */
    public function parseArg(string $arg): array;

    /** @param array<int> $ids */
    public function createJson(array $ids): string;
}
