<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\model\chan\cache;

use Predis;
use Predis\Pipeline\Pipeline;
use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntArc;
use straininfo\server\mvvm\model\chan\RedisMWr;
use function straininfo\server\shared\arr\filter_arr_no_null;
use straininfo\server\shared\mvvm\model\redis\RedisStE;

use straininfo\server\shared\mvvm\view_model\data\QDE;

final class CaRArc extends RedisMWr implements CaMIntArc
{
    public function __construct(?Predis\Client $dbc)
    {
        parent::__construct($dbc, true);
    }

    /**
     * @param array<string> $ids
     *
     * @return array<string, string>
     */
    public function getArcBySiId(array $ids): array
    {
        return filter_arr_no_null(
            self::filterCheck(...),
            $this->getArcById($ids, RedisStE::P_ARC->value . QDE::MAX->value . ':')
        );
    }

    /**
     * @param array<string> $ids
     *
     * @return array<string, ?string>
     */
    private function getArcById(array $ids, string $dbn): array
    {
        $this->checkMaintenanceMode();
        $res = $this->getDBC()->pipeline(
            static function (Pipeline $red) use ($ids, $dbn): void {
                foreach ($ids as $id) {
                    $red->get($dbn . $id);
                }
            }
        );
        if (is_array($res)) {
            return array_combine($ids, $res);
        }
        return [];
    }

    private static function filterCheck(?string $v_el): bool
    {
        return !is_null($v_el) && strlen($v_el) > 0;
    }
}
