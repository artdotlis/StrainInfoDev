<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\model\chan\cache;

use Predis\Pipeline\Pipeline;
use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntDat;
use straininfo\server\mvvm\model\chan\RedisMWr;
use function straininfo\server\shared\arr\filter_arr_no_null;
use straininfo\server\shared\mvvm\view\api\VersionE;

use straininfo\server\shared\mvvm\view_model\data\QDE;

final class CaRDat extends RedisMWr implements CaMIntDat
{
    private readonly string $prefix;

    /** @param callable(): \Predis\Client|null $dbc */
    public function __construct(?callable $dbc, string $prefix)
    {
        $this->prefix = $prefix;
        parent::__construct($dbc, true);
    }

    /**
     * @param array<int> $ids
     *
     * @return array<int, string>
     */
    public function getMin(array $ids, VersionE $version): array
    {
        return filter_arr_no_null(
            self::filterCheck(...),
            $this->getEntById($ids, $this->prefix .  $version->value .'_'.QDE::MIN->value . ':')
        );
    }

    /**
     * @param array<int> $ids
     *
     * @return array<int, ?string>
     */
    public function getAvg(array $ids, VersionE $version): array
    {
        return filter_arr_no_null(
            self::filterCheck(...),
            $this->getEntById($ids, $this->prefix . $version->value .'_'. QDE::AVG->value . ':')
        );
    }

    /**
     * @param array<int> $ids
     *
     * @return array<int, ?string>
     */
    public function getMax(array $ids, VersionE $version): array
    {
        return filter_arr_no_null(
            self::filterCheck(...),
            $this->getEntById($ids, $this->prefix . $version->value .'_'. QDE::MAX->value . ':')
        );
    }
    /**
     * @param array<int> $ids
     *
     * @return array<int, ?string>
     */
    public function getMic(array $ids): array
    {
        return filter_arr_no_null(
            self::filterCheck(...),
            $this->getEntById($ids, $this->prefix . QDE::MIC->value . ':')
        );
    }

    /**
     * @param array<int> $index
     *
     * @return array<int, ?string>
     */
    public function getMicInd(array $index): array
    {
        return filter_arr_no_null(
            self::filterCheck(...),
            $this->getEntById($index, $this->prefix . QDE::MIC_IND->value . ':')
        );
    }
    /**
     * @param array<int> $ids
     *
     * @return array<int, ?string>
     */
    private function getEntById(array $ids, string $dbn): array
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
