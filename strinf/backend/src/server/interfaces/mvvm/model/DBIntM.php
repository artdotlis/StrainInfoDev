<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\model;

use straininfo\server\interfaces\mvvm\model\chan\query\QMIntAll;
use straininfo\server\interfaces\mvvm\model\chan\query\QMIntArc;
use straininfo\server\interfaces\mvvm\model\chan\query\QMIntCnt;
use straininfo\server\interfaces\mvvm\model\chan\query\QMIntDat;
use straininfo\server\interfaces\mvvm\model\chan\query\QMIntSeaIdCul;
use straininfo\server\interfaces\mvvm\model\chan\query\QMIntSeaIdStr;
use straininfo\server\interfaces\mvvm\model\chan\query\QMIntStat;
use straininfo\server\shared\mvvm\model\DBArgs;

/**
 * @template TC
 * @template TS
 */
interface DBIntM
{
    /** @return QMIntDat<TC> */
    public function getQDBCul(): QMIntDat;

    /** @return QMIntDat<TS> */
    public function getQDBStr(): QMIntDat;

    public function getQDBCulSea(): QMIntSeaIdCul;

    public function getQDBStrSea(): QMIntSeaIdStr;

    public function getQDBArc(): QMIntArc;

    public function getQDBCnt(): QMIntCnt;

    public function getQDBAll(): QMIntAll;

    public function getQDBStat(): QMIntStat;

    public function getQDBConf(): DBArgs;
}
