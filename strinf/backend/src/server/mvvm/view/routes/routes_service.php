<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\mvvm\view\routes;

use Slim\App;
use straininfo\server\mvvm\view\const\ConCtrl;
use straininfo\server\shared\mvvm\view\api\query\service\QAllE;
use straininfo\server\shared\mvvm\view\api\query\service\QArcE;
use straininfo\server\shared\mvvm\view\api\query\service\QOptSeaE;
use straininfo\server\shared\mvvm\view\api\query\service\QStatE;

/** @param App<\Psr\Container\ContainerInterface|null> $app
 *
 * @return array<\Slim\Interfaces\RouteInterface> */
function init_query_all_ser(App $app, ConCtrl $ctrl_con): array
{
    $dba = $ctrl_con->getDBSCtrlAll();
    return [
        $app->get(QAllE::STR->value, $dba->getAllStrains(...)),
        $app->get(QAllE::STR_TYP->value, $dba->getAllTStrains(...)),
        $app->get(QAllE::CUL_TYP->value, $dba->getAllTCultures(...)),
        $app->get(QAllE::CUL->value, $dba->getAllCultures(...)),
    ];
}

/** @param App<\Psr\Container\ContainerInterface|null> $app
 *
 * @return array<\Slim\Interfaces\RouteInterface> */
function init_query_stat_ser(App $app, ConCtrl $ctrl_con): array
{
    $dbd = $ctrl_con->getDBSCtrlStat();
    return [
        $app->get(QStatE::DPS_CNT->value, $dbd->getDisCPSCnt(...)),
    ];
}

/** @param App<\Psr\Container\ContainerInterface|null> $app
 *
 * @return array<\Slim\Interfaces\RouteInterface>
 */
function init_query_arc_ser(App $app, ConCtrl $ctrl_con): array
{
    $dbs = $ctrl_con->getDBSCtrlArc();
    return [
        $app->get(QArcE::ARC->value, $dbs->getArcBySiId(...)),
    ];
}

/** @param App<\Psr\Container\ContainerInterface|null> $app
 *
 * @return array<\Slim\Interfaces\RouteInterface> */
function init_query_ind_ser(App $app, ConCtrl $ctrl_con): array
{
    $dbs = $ctrl_con->getDBSCtrlSeaOpt();
    return [
        $app->get(QOptSeaE::IND_ENT->value, $dbs->getIndByKey(...)),
        $app->get(QOptSeaE::SEA_ENT->value, $dbs->getSeaMic(...)),
        $app->get(QOptSeaE::SEA_ALL_ENT->value, $dbs->getSeaMicAll(...)),
    ];
}
