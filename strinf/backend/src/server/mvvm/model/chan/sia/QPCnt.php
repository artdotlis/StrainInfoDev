<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\mvvm\model\chan\sia;

use straininfo\server\interfaces\mvvm\model\chan\query\QMIntCnt;
use straininfo\server\mvvm\model\chan\PdoMWr;

use function straininfo\server\shared\mvvm\model\pdo\parse_row_2_arr;
use function straininfo\server\shared\mvvm\model\sia\sql\get_archive_cnt;
use function straininfo\server\shared\mvvm\model\sia\sql\get_cul_cnt;
use function straininfo\server\shared\mvvm\model\sia\sql\get_cul_type_cnt;
use function straininfo\server\shared\mvvm\model\sia\sql\get_des_cnt;
use function straininfo\server\shared\mvvm\model\sia\sql\get_spe_cnt;
use function straininfo\server\shared\mvvm\model\sia\sql\get_str_cnt;
use function straininfo\server\shared\mvvm\model\sia\sql\get_str_type_cnt;

final class QPCnt extends PdoMWr implements QMIntCnt
{
    /** @param callable(): \PDO|null $dbc */
    public function __construct(?callable $dbc)
    {
        parent::__construct($dbc, true);
    }

    public function getStrainCount(): int
    {
        return $this->getRes(get_str_cnt());
    }

    public function getArchiveCount(): int
    {
        return $this->getRes(get_archive_cnt());
    }

    public function getTypeStrainCount(): int
    {
        return $this->getRes(get_str_type_cnt());
    }

    public function getTypeCultureCount(): int
    {
        return $this->getRes(get_cul_type_cnt());
    }

    public function getDesignationCount(): int
    {
        return $this->getRes(get_des_cnt());
    }

    public function getCultureCount(): int
    {
        return $this->getRes(get_cul_cnt());
    }

    public function getSpeciesCount(): int
    {
        return $this->getRes(get_spe_cnt());
    }

    private function getRes(string $sta): int
    {
        $this->checkMaintenanceMode();
        $sta = $this->getDBC()->prepare($sta);
        $sta->setFetchMode(\PDO::FETCH_NUM);
        $res = parse_row_2_arr(
            $sta,
            static fn (string|int $ele): int => (int) $ele
        );
        return $res[0] ?? 0;
    }
}
