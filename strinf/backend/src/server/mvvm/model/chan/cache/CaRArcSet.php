<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\model\chan\cache;

use Predis\Pipeline\Pipeline;
use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntArcSet;
use straininfo\server\mvvm\model\chan\RedisMWr;
use straininfo\server\shared\mvvm\model\redis\RedisStE;
use straininfo\server\shared\mvvm\view_model\data\QDE;

final class CaRArcSet extends RedisMWr implements CaMIntArcSet
{
    private readonly int $ex_s;
    private readonly int $limit;

    /** @param callable(): \Predis\Client|null $dbc */
    public function __construct(?callable $dbc, int $ex_h, int $limit)
    {
        $this->ex_s = 3_600 * $ex_h;
        $this->limit = $limit;
        parent::__construct($dbc, true);
    }

    /** @param array<string, string> $data */
    public function setArcBySiId(array $data): void
    {
        $this->setArcById($data, RedisStE::P_ARC->value . QDE::MAX->value . ':');
    }

    /** @param array<string, string> $data */
    private function setArcById(array $data, string $dbn): void
    {
        $this->checkMaintenanceMode();
        if (count($data) < $this->limit) {
            $ex_s = $this->ex_s;
            $this->getDBC()->pipeline(
                static function (Pipeline $red) use (
                    $data,
                    $dbn,
                    $ex_s
                ): void {
                    foreach ($data as $id => $json) {
                        $red->set($dbn . $id, $json, 'ex', $ex_s);
                    }
                }
            );
        }
    }
}
