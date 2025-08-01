<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\model\chan\sia;

use straininfo\server\interfaces\mvvm\model\chan\query\QMIntStat;
use straininfo\server\mvvm\model\chan\PdoMWr;

use function straininfo\server\shared\arr\count_val_in_arr;
use function straininfo\server\shared\arr\merge_2d_arr;
use function straininfo\server\shared\mvvm\model\pdo\parse_col_2_arr;
use function straininfo\server\shared\mvvm\model\sia\sql\get_dis_cul_per_str_cnt;

final class QPStat extends PdoMWr implements QMIntStat
{
    /** @param callable(): \PDO|null $dbc */
    public function __construct(?callable $dbc)
    {
        parent::__construct($dbc, true);
    }

    /** @return array<string, array<int>> */
    public function getCulPStrCnt(): array
    {
        $this->checkMaintenanceMode();
        return $this->getRes(
            $this->getSQL(get_dis_cul_per_str_cnt())
        );
    }

    /** @return array<int, int> */
    private function getSQL(string $sql): array
    {
        $sta = $this->getDBC()->prepare($sql);
        $sta->setFetchMode(\PDO::FETCH_COLUMN, 0);
        $keys = parse_col_2_arr(
            $sta,
            static fn (string|int $ele): int => (int) $ele
        );
        $sta->setFetchMode(\PDO::FETCH_COLUMN, 1);
        $values = parse_col_2_arr(
            $sta,
            static fn (string|int $ele): int => (int) $ele
        );
        return merge_2d_arr($keys, $values);
    }

    /**
     * @param array<int, int> $cis
     *
     * @return array<string, array<int>>
     */
    private function getRes(array $cis): array
    {
        /** @var array<string, array<int>> $res */
        $res = [];
        $res['deposits per strain'] = [];
        $res['count'] = [];
        foreach (count_val_in_arr($cis) as $cps => $count) {
            $res['deposits per strain'][] = $cps;
            $res['count'][] = $count;
        }
        return $res;
    }
}
