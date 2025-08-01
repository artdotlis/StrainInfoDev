<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\model\chan\cache;

use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntCnt;
use straininfo\server\mvvm\model\chan\RedisMWr;
use straininfo\server\shared\mvvm\model\redis\RedisStE;

final class CaRCnt extends RedisMWr implements CaMIntCnt
{
    /** @param callable(): \Predis\Client|null $dbc */
    public function __construct(?callable $dbc)
    {
        parent::__construct($dbc, true);
    }

    public function getRes(string $tag): int
    {
        $this->checkMaintenanceMode();
        $res = $this->getDBC()->get($tag);
        return (int) ($res ?? -1);
    }

    public function getStrainCount(): int
    {
        return $this->getRes(RedisStE::STR_CNT->value);
    }

    public function getArchiveCount(): int
    {
        return $this->getRes(RedisStE::ARC_CNT->value);
    }

    public function getTypeStrainCount(): int
    {
        return $this->getRes(RedisStE::STR_TYP_CNT->value);
    }

    public function getTypeCultureCount(): int
    {
        return $this->getRes(RedisStE::CUL_TYP_CNT->value);
    }

    public function getCultureCount(): int
    {
        return $this->getRes(RedisStE::CUL_CNT->value);
    }

    public function getDesignationCount(): int
    {
        return $this->getRes(RedisStE::DES_CNT->value);
    }

    public function getSpeciesCount(): int
    {
        return $this->getRes(RedisStE::SPE_CNT->value);
    }
}
