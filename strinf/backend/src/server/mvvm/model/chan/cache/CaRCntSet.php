<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\model\chan\cache;

use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntCntSet;
use straininfo\server\mvvm\model\chan\RedisMWr;
use straininfo\server\shared\mvvm\model\redis\RedisStE;

final class CaRCntSet extends RedisMWr implements CaMIntCntSet
{
    /** @param callable(): \Redis|null $dbc */
    public function __construct(?callable $dbc)
    {
        parent::__construct($dbc, true);
    }

    public function setRes(string $type, int $cnt): void
    {
        $this->checkMaintenanceMode();
        $this->getDBC()->set($type, $cnt);
    }

    public function setStrainCount(int $cnt): void
    {
        $this->setRes(RedisStE::STR_CNT->value, $cnt);
    }

    public function setArchiveCount(int $cnt): void
    {
        $this->setRes(RedisStE::ARC_CNT->value, $cnt);
    }

    public function setTypeStrainCount(int $cnt): void
    {
        $this->setRes(RedisStE::STR_TYP_CNT->value, $cnt);
    }

    public function setTypeCultureCount(int $cnt): void
    {
        $this->setRes(RedisStE::CUL_TYP_CNT->value, $cnt);
    }

    public function setCultureCount(int $cnt): void
    {
        $this->setRes(RedisStE::CUL_CNT->value, $cnt);
    }

    public function setSpeciesCount(int $cnt): void
    {
        $this->setRes(RedisStE::SPE_CNT->value, $cnt);
    }

    public function setDesignationCount(int $cnt): void
    {
        $this->setRes(RedisStE::DES_CNT->value, $cnt);
    }
}
