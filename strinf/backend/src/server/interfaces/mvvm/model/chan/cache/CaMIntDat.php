<?php

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\model\chan\cache;

use straininfo\server\interfaces\mvvm\model\chan\MainChannel;
use straininfo\server\shared\mvvm\view\api\VersionE;

interface CaMIntDat extends MainChannel
{
    /**
     * @param array<int> $ids
     *
     * @return array<int, string>
     */
    public function getMin(array $ids, VersionE $version): array;

    /**
     * @param array<int> $ids
     *
     * @return array<int, string>
     */
    public function getAvg(array $ids, VersionE $version): array;

    /**
     * @param array<int> $ids
     *
     * @return array<int, string>
     */
    public function getMax(array $ids, VersionE $version): array;

    /**
     * @param array<int> $ids
     *
     * @return array<int, string>
     */
    public function getMic(array $ids): array;

    /**
     * @param array<int> $index
     *
     * @return array<int, string>
     */
    public function getMicInd(array $index): array;
}
