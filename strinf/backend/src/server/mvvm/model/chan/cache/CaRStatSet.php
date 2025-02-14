<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\model\chan\cache;

use Predis;
use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntStatSet;
use straininfo\server\mvvm\model\chan\RedisMWr;
use straininfo\server\shared\mvvm\model\redis\RedisStE;

final class CaRStatSet extends RedisMWr implements CaMIntStatSet
{
    public function __construct(?Predis\Client $dbc)
    {
        parent::__construct($dbc, true);
    }

    public function setCulPStrCnt(string $data): void
    {
        $this->setRes($data, RedisStE::DIS_CPS_CNT->value);
    }

    private function setRes(string $data, string $tag): void
    {
        $this->checkMaintenanceMode();
        $this->getDBC()->set($tag, $data);
    }
}
