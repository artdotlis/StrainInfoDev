<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\model\chan\sia;

use straininfo\server\interfaces\mvvm\model\chan\query\QMIntArc;
use straininfo\server\mvvm\model\chan\PdoMWr;

use function straininfo\server\shared\mvvm\model\pdo\bind_and_exe;
use function straininfo\server\shared\mvvm\model\sia\sql\get_arc_si_id;
use function straininfo\server\shared\mvvm\model\sia\sql\parse_sql_arc_id;

final class QPArc extends PdoMWr implements QMIntArc
{
    /** @param callable(): \PDO|null $dbc */
    public function __construct(?callable $dbc)
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
        return $this->fetchConSql($ids, get_arc_si_id(count($ids)));
    }

    /**
     * @param array<string> $params
     *
     * @return array<string, string>
     */
    private function fetchConSql(array $params, string $sql): array
    {
        $this->checkMaintenanceMode();
        $sta = $this->prepDefSta($sql);
        $res = [];
        if (bind_and_exe($sta, $params, \PDO::PARAM_STR)) {
            $res = parse_sql_arc_id($sta->fetchAll());
        }
        return $res;
    }
}
