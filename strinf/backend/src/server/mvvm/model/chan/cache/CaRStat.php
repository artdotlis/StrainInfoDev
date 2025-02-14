<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\model\chan\cache;

use Predis;
use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntStat;
use straininfo\server\mvvm\model\chan\RedisMWr;
use straininfo\server\shared\mvvm\model\redis\RedisStE;

final class CaRStat extends RedisMWr implements CaMIntStat
{
    public function __construct(?Predis\Client $dbc)
    {
        parent::__construct($dbc, true);
    }

    public function getCulPStrCnt(): string
    {
        return $this->getRes(RedisStE::DIS_CPS_CNT->value);
    }

    public function getRes(string $tag): string
    {
        $this->checkMaintenanceMode();
        $res = $this->getDBC()->get($tag);
        return (string) ($res ?? '');
    }
}
