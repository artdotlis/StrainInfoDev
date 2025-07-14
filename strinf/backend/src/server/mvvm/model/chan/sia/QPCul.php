<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\model\chan\sia;

use straininfo\server\interfaces\mvvm\model\chan\query\QMIntDat;
use straininfo\server\mvvm\model\chan\PdoMWr;
use function straininfo\server\shared\mvvm\model\pdo\bind_and_exe;

use function straininfo\server\shared\mvvm\model\sia\sql\cul\get_cul_id_avg;
use function straininfo\server\shared\mvvm\model\sia\sql\cul\get_cul_id_max;
use function straininfo\server\shared\mvvm\model\sia\sql\cul\get_cul_id_min;
use function straininfo\server\shared\mvvm\model\sia\sql\parse_sql_cul_id;
use function straininfo\server\shared\mvvm\model\sia\sql\parse_sql_main_str_id;
use function straininfo\server\shared\mvvm\model\sia\sql\parse_sql_merge_str_id;
use function straininfo\server\shared\mvvm\model\sia\sql\str\get_full_strain;
use function straininfo\server\shared\mvvm\model\sia\sql\str\get_min_strain;
use function straininfo\server\shared\mvvm\model\sia\sql\str\get_sql_merge_src_str_id;
use function straininfo\server\shared\mvvm\model\sia\sql\str\get_sql_strain_err;
use function straininfo\server\shared\mvvm\model\sia\sql\str\get_sql_strain_online;
use function straininfo\server\shared\mvvm\model\sia\sql\str\get_str_id_max;
use function straininfo\server\shared\mvvm\model\sia\sql\str\get_strain_type_cul;
use straininfo\server\shared\mvvm\model\struct\DataCon;

/** @implements QMIntDat<array<string, mixed>> */
final class QPCul extends PdoMWr implements QMIntDat
{
    public function __construct(?\PDO $dbc)
    {
        parent::__construct($dbc, true);
    }

    /**
     * @param array<int> $ids
     *
     * @return array<array<string, mixed>>
     */
    public function getMin(array $ids): array
    {
        $this->checkMaintenanceMode();
        return $this->getMinSql($ids, get_cul_id_min());
    }

    /**
     * @param array<int> $ids
     *
     * @return array<array<string, mixed>>
     */
    public function getAvg(array $ids): array
    {
        $this->checkMaintenanceMode();
        return $this->getAvgSql($ids, get_cul_id_avg());
    }

    /**
     * @param array<int> $ids
     *
     * @return array<array<string, mixed>>
     */
    public function getMax(array $ids): array
    {
        $this->checkMaintenanceMode();
        return $this->getMaxSql($ids, get_cul_id_max());
    }

    /**
     * @param array<string, object> $sub
     * @param array<string> $sta_str
     *
     * @return array{array<string, array<array<string, object>>>, int, array<int>}
     */
    private function getCulCon(array $sub, array $sta_str): array
    {
        $main_id = parse_sql_main_str_id($sub);
        $cul_id = parse_sql_cul_id($sub);
        $dep = [
            DataCon::DEP->value => $this->fetchConSql($sta_str[2], [$cul_id]),
        ];
        $iso = [
            DataCon::ISO->value => $this->fetchConSql($sta_str[3], [$cul_id]),
        ];
        $reg = [
            DataCon::REG->value => [
                ...$this->fetchConSql($sta_str[1], [$cul_id]),
                ...$this->fetchConSql($sta_str[4], [$cul_id]),
            ],
        ];
        $rel_des = [
            DataCon::R_DES_C->value => $this->fetchConSql($sta_str[5], [$cul_id]),
        ];
        $merge_ids = array_map(
            parse_sql_merge_str_id(...),
            $this->fetchConSql(get_sql_merge_src_str_id(), [$main_id])
        );
        return [array_merge($reg, $dep, $iso, $rel_des), $main_id, $merge_ids];
    }

    /**
     * @param array<int> $merge_ids
     *
     * @return array<string, array<int>|object>
     */
    private function getStrCon(int $str_id, array $merge_ids, string $strain_sql): array
    {
        $res = $this->fetchConSql(get_strain_type_cul(), [$str_id]);
        return [
            ...$this->fetchConSql($strain_sql, [$str_id])[0],
            ...(count($res) > 0 ? $res[0] : []),
            DataCon::MER->value => $merge_ids,
        ];
    }

    /**
     * @param array<string> $sta_str
     *
     * @return array<string, array<array<string, object>>>
     */
    private function getFullStrCon(int $main_id, array $sta_str): array
    {
        return array_merge(
            [DataCon::LIT->value => $this->fetchConSql(
                $sta_str[0],
                [$main_id]
            ),
            ],
            [DataCon::SEQ->value => $this->fetchConSql(
                $sta_str[1],
                [$main_id]
            ),
            ],
            [DataCon::R_CUL->value => $this->fetchConSql(
                $sta_str[2],
                [$main_id]
            ),
            ],
            [DataCon::R_DES_S->value => $this->fetchConSql(
                $sta_str[3],
                [$main_id, $main_id]
            ),
            ],
            [DataCon::ARC->value => $this->fetchConSql(
                $sta_str[4],
                [$main_id]
            ),
            ]
        );
    }

    /**
     * @param array<int> $ids
     * @param array<string> $sta_cul
     *
     * @return array<array<string, mixed>>
     */
    private function getMaxSql(array $ids, array $sta_cul): array
    {
        $buf = [];
        foreach ($ids as $id) {
            $sub = $this->fetchConSql($sta_cul[0], [$id]);
            if (!$sub) {
                continue;
            }
            $buf_con = $this->getCulCon($sub[0], $sta_cul);
            [$info, $main_id, $merge_ids] = $buf_con;
            $sta_str = get_str_id_max();
            array_push($buf, array_merge(
                $sub[0],
                $info,
                $this->getStrCon($main_id, $merge_ids, get_full_strain()),
                $this->getFullStrCon($main_id, $sta_str),
                ...$this->fetchConSql(
                    get_sql_strain_online(),
                    [$main_id]
                ),
                ...$this->fetchConSql(
                    get_sql_strain_err(),
                    [$main_id]
                )
            ));
        }
        return $buf;
    }

    /**
     * @param array<int> $ids
     * @param array<string> $sta_cul
     *
     * @return array<array<string, array<array<string, object>>|object>>
     */
    private function getMinSql(array $ids, array $sta_cul): array
    {
        $buf = [];
        foreach ($ids as $id) {
            $sub = $this->fetchConSql($sta_cul[0], [$id]);
            if (!$sub) {
                continue;
            }
            $reg = [
                DataCon::REG->value => $this->fetchConSql(
                    $sta_cul[1],
                    [parse_sql_cul_id($sub[0])]
                ),
            ];
            $buf[] = array_merge($sub[0], $reg);
        }
        return $buf;
    }

    /**
     * @param array<int> $ids
     * @param array<string> $sta_cul
     *
     * @return array<array<string, array<array<string, object>|int>|object>>
     */
    private function getAvgSql(array $ids, array $sta_cul): array
    {
        $buf = [];
        foreach ($ids as $id) {
            $sub = $this->fetchConSql($sta_cul[0], [$id]);
            if (!$sub) {
                continue;
            }
            $buf_con = $this->getCulCon($sub[0], $sta_cul);
            [$info, $main_id, $merge_ids] = $buf_con;
            $buf[] = array_merge(
                $sub[0],
                $info,
                $this->getStrCon($main_id, $merge_ids, get_min_strain())
            );
        }
        return $buf;
    }

    /**
     * @param array<int|string> $args
     *
     * @return array<array<string, object>>
     */
    private function fetchConSql(
        string $sql,
        array $args,
        int $type = \PDO::PARAM_INT
    ): array {
        $sta = $this->prepDefSta($sql);
        if (bind_and_exe($sta, $args, $type)) {
            return $sta->fetchAll() ?: [];
        }
        return [];
    }
}
