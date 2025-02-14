<?php

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\view_model\chan\cache;

use straininfo\server\shared\mvvm\view_model\data\QDConSea;

/** @template T of string|int */
interface CaVMIntSeaId
{
    /** @param QDConSea<T> $sea_con */
    public function setResult(QDConSea $sea_con): void;

    /**
     * @param array<T> $arg
     *
     * @return QDConSea<T>
     */
    public function getResult(array $arg): QDConSea;
}
