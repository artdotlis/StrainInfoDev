<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\view_model\chan\sea\cache;

use function straininfo\server\shared\arr\filter_arr;

use straininfo\server\shared\mvvm\view_model\data\QDConSea;

/**
 * @extends CaVMChanSea<int, \straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntSeaIdStr, \straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntSeaIdSetStr>
 */
final class CaVMStrCul extends CaVMChanSea
{
    /**
     * @param array<int> $arg
     *
     * @return QDConSea<int>
     */
    public function getResult(array $arg): QDConSea
    {
        $str = filter_arr(
            static fn (array $val): bool => (bool) $val,
            $this->getMChan()->getCulId($arg)
        );
        return new QDConSea(array_diff($arg, array_keys($str)), $str);
    }

    /** @param QDConSea<int> $sea_con */
    public function setResult(QDConSea $sea_con): void
    {
        if ($sea_con->getToBuf()) {
            $this->getMSetChan()->setCulId($sea_con->getToBuf());
        }
    }
}
