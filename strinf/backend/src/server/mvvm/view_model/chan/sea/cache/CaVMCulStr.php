<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\view_model\chan\sea\cache;

use straininfo\server\shared\mvvm\view_model\data\QDConSea;

/**
 * @extends CaVMChanSea<int, \straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntSeaIdCul, \straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntSeaIdSetCul>
 */
final class CaVMCulStr extends CaVMChanSea
{
    /**
     * @param array<int> $arg
     *
     * @return QDConSea<int>
     */
    public function getResult(array $arg): QDConSea
    {
        $str = array_filter(
            $this->getMChan()->getStrId($arg),
            static fn (string $val): bool => $val !== '',
        );
        return new QDConSea(array_diff($arg, array_keys($str)), $str);
    }

    /** @param QDConSea<int> $sea_con */
    public function setResult(QDConSea $sea_con): void
    {
        if ($sea_con->getToBuf()) {
            $this->getMSetChan()->setStrId($sea_con->getToBuf());
        }
    }
}
