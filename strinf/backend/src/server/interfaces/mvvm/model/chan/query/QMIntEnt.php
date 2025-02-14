<?php

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\model\chan\query;

interface QMIntEnt
{
    /**
     * @return array<array{string, int, int}>
     */
    public function getTaxonNSId(): array;

    /**
     * @return array<array{string, int, int}>
     */
    public function getDesSId(): array;

    /**
     * @return array<array{string, int, int}>
     */
    public function getCcnoSId(): array;

    /**
     * @return array<array{string, int, int}>
     */
    public function getSeqAccSId(): array;

    /**
     * @return array<array{string, int, int}>
     */
    public function getBRCSId(): array;
}
