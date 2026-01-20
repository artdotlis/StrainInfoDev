<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\mvvm\model\chan\sia;

use straininfo\server\interfaces\mvvm\model\chan\query\QMIntEnt;
use straininfo\server\mvvm\model\chan\PdoMWr;

use function straininfo\server\shared\mvvm\model\pdo\parse_rows_2_arr;
use function straininfo\server\shared\mvvm\model\sia\sql\get_brc_entity_index;
use function straininfo\server\shared\mvvm\model\sia\sql\get_ccno_entity_index;
use function straininfo\server\shared\mvvm\model\sia\sql\get_des_entity_index;
use function straininfo\server\shared\mvvm\model\sia\sql\get_seq_acc_entity_index;
use function straininfo\server\shared\mvvm\model\sia\sql\get_taxon_name_entity_index;
use function straininfo\server\shared\mvvm\model\sia\sql\parse_sql_index_entity;
use function straininfo\server\shared\mvvm\model\sia\sql\parse_sql_index_entity_ccno;

final class QPEnt extends PdoMWr implements QMIntEnt
{
    /** @param callable(): \PDO|null $dbc */
    public function __construct(?callable $dbc)
    {
        parent::__construct($dbc, false);
    }

    /**
     * @return array<array{string, int, int}>
     */
    public function getTaxonNSId(): array
    {
        return $this->getRes(get_taxon_name_entity_index(), parse_sql_index_entity(...));
    }

    /**
     * @return array<array{string, int, int}>
     */
    public function getDesSId(): array
    {
        return $this->getRes(get_des_entity_index(), parse_sql_index_entity(...));
    }

    /**
     * @return array<array{string, int, int}>
     */
    public function getCcnoSId(): array
    {
        return $this->getRes(get_ccno_entity_index(), parse_sql_index_entity_ccno(...));
    }

    /**
     * @return array<array{string, int, int}>
     */
    public function getSeqAccSId(): array
    {
        return $this->getRes(get_seq_acc_entity_index(), parse_sql_index_entity(...));
    }

    /**
     * @return array<array{string, int, int}>
     */
    public function getBRCSId(): array
    {
        return $this->getRes(get_brc_entity_index(), parse_sql_index_entity(...));
    }

    /**
     * @param callable(array<string|int>): array{string, int, int} $cast
     *
     * @return array<array{string, int, int}>
     */
    private function getRes(string $sta, callable $cast): array
    {
        $this->checkMaintenanceMode();
        $sta = $this->getDBC()->prepare($sta);
        $sta->setFetchMode(\PDO::FETCH_NUM);
        return parse_rows_2_arr(
            $sta,
            $cast
        );
    }
}
