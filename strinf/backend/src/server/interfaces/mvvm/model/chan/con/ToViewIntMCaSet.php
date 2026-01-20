<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\model\chan\con;

use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntAllSet;
use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntArcSet;
use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntCntSet;
use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntDatSet;
use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntSeaIdSetCul;
use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntSeaIdSetStr;
use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntStatSet;

interface ToViewIntMCaSet
{
    public function getCaMCul(): CaMIntDatSet;

    public function getCaMStr(): CaMIntDatSet;

    public function getCaMCulSea(): CaMIntSeaIdSetCul;

    public function getCaMStrSea(): CaMIntSeaIdSetStr;

    public function getCaMArc(): CaMIntArcSet;

    public function getCaMAll(): CaMIntAllSet;

    public function getCaMStat(): CaMIntStatSet;

    public function getCaMCnt(): CaMIntCntSet;

    public function setMaintenance(bool $maintenance): void;
}
