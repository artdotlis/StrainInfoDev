<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\mvvm\view\routes;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\App;
use straininfo\server\mvvm\view\const\ConCtrl;
use straininfo\server\shared\mvvm\view\api\query\v2\QCntE;
use straininfo\server\shared\mvvm\view\api\query\v2\QDepE;
use straininfo\server\shared\mvvm\view\api\query\v2\QSeaDepIE;
use straininfo\server\shared\mvvm\view\api\query\v2\QSeaStrIE;
use straininfo\server\shared\mvvm\view\api\query\v2\QStrE;
use straininfo\server\shared\mvvm\view\api\VersionE;

/**
 * @param callable(QCntE, ServerRequestInterface, ResponseInterface): ResponseInterface $cb
 */
function pwr_cnt_v2(
    QCntE $path,
    callable $cb
): callable {
    return static function (
        ServerRequestInterface $request,
        ResponseInterface $response
    ) use ($path, $cb): ResponseInterface {
        return $cb($path, $request, $response);
    };
}
/**
 * @template T of QSeaStrIE|QSeaDepIE
 *
 * @param T $path
 * @param T $arg_name
 * @param callable(T, T, ServerRequestInterface, ResponseInterface, array<string>): ResponseInterface $cb
 */
function pwr_sea_v2(
    $path,
    $arg_name,
    callable $cb
): callable {
    return static function (
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ) use ($path, $arg_name, $cb): ResponseInterface {
        return $cb($path, $arg_name, $request, $response, $args);
    };
}

/**
 * @template T of QStrE|QDepE
 *
 * @param T $path
 * @param T $arg_name
 * @param callable(T, T, VersionE, ServerRequestInterface, ResponseInterface, array<string>): ResponseInterface $cb
 */
function pwr_dat_v2(
    $path,
    $arg_name,
    callable $cb
): callable {
    return static function (
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ) use ($path, $arg_name, $cb): ResponseInterface {
        return $cb($path, $arg_name, VersionE::V2, $request, $response, $args);
    };
}

/**
 * @param App<\Psr\Container\ContainerInterface|null> $app
 *
 * @return array<\Slim\Interfaces\RouteInterface>
 */
function init_query_cul_v2(App $app, ConCtrl $ctrl_con): array
{
    $dbs = $ctrl_con->getDBSCtrlCul();
    return [
        $app->get(QDepE::AVG->value, pwr_dat_v2(QDepE::AVG, QDepE::ID_P, $dbs->getAvg(...))),
        $app->get(QDepE::MAX->value, pwr_dat_v2(QDepE::MAX, QDepE::ID_P, $dbs->getMax(...))),
        $app->get(QDepE::MIN->value, pwr_dat_v2(QDepE::MIN, QDepE::ID_P, $dbs->getMin(...))),
    ];
}

/**
 * @param App<\Psr\Container\ContainerInterface|null> $app
 *
 * @return array<\Slim\Interfaces\RouteInterface>
 */
function init_query_str_v2(App $app, ConCtrl $ctrl_con): array
{
    $dbs = $ctrl_con->getDBSCtrlStr();
    return [
        $app->get(QStrE::AVG->value, pwr_dat_v2(QStrE::AVG, QStrE::ID_P, $dbs->getAvg(...))),
        $app->get(QStrE::MAX->value, pwr_dat_v2(QStrE::MAX, QStrE::ID_P, $dbs->getMax(...))),
        $app->get(QStrE::MIN->value, pwr_dat_v2(QStrE::MIN, QStrE::ID_P, $dbs->getMin(...))),
    ];
}

/** @param App<\Psr\Container\ContainerInterface|null> $app
 *
 * @return array<\Slim\Interfaces\RouteInterface> */
function init_query_sea_cul_v2(App $app, ConCtrl $ctrl_con): array
{
    $dbs = $ctrl_con->getDBSCtrlCulSea();
    return [
        $app->get(QSeaDepIE::SEQ_ACC->value, pwr_sea_v2(QSeaDepIE::SEQ_ACC, QSeaDepIE::SEQ_ACC_P, $dbs->getSeq(...))),
        $app->get(QSeaDepIE::SI_ID->value, pwr_sea_v2(QSeaDepIE::SI_ID, QSeaDepIE::SI_ID_P, $dbs->getStr(...))),
        $app->get(QSeaDepIE::TAX_NAME->value, pwr_sea_v2(QSeaDepIE::TAX_NAME, QSeaDepIE::TAX_NAME_P, $dbs->getTaxName(...))),
        $app->get(QSeaDepIE::DES->value, pwr_sea_v2(QSeaDepIE::DES, QSeaDepIE::DES_P, $dbs->getStrDes(...))),
        $app->get(QSeaDepIE::CC_NO->value, pwr_sea_v2(QSeaDepIE::CC_NO, QSeaDepIE::CC_NO_P, $dbs->getStrNo(...))),
        $app->get(QSeaDepIE::CC->value, pwr_sea_v2(QSeaDepIE::CC, QSeaDepIE::CC_P, $dbs->getBrc(...))),
    ];
}

/** @param App<\Psr\Container\ContainerInterface|null> $app
 *
 * @return array<\Slim\Interfaces\RouteInterface> */
function init_query_sea_str_v2(App $app, ConCtrl $ctrl_con): array
{
    $dbs = $ctrl_con->getDBSCtrlStrSea();
    return [
        $app->get(QSeaStrIE::SEQ_ACC->value, pwr_sea_v2(QSeaStrIE::SEQ_ACC, QSeaStrIE::SEQ_ACC_P, $dbs->getSeq(...))),
        $app->get(QSeaStrIE::TAX_NAME->value, pwr_sea_v2(QSeaStrIE::TAX_NAME, QSeaStrIE::TAX_NAME_P, $dbs->getTaxName(...))),
        $app->get(QSeaStrIE::DES->value, pwr_sea_v2(QSeaStrIE::DES, QSeaStrIE::DES_P, $dbs->getStrDes(...))),
        $app->get(QSeaStrIE::CC_NO->value, pwr_sea_v2(QSeaStrIE::CC_NO, QSeaStrIE::CC_NO_P, $dbs->getStrNo(...))),
        $app->get(QSeaStrIE::CC->value, pwr_sea_v2(QSeaStrIE::CC, QSeaStrIE::CC_P, $dbs->getBrc(...))),
        $app->get(QSeaStrIE::SI_DP->value, pwr_sea_v2(QSeaStrIE::SI_DP, QSeaStrIE::SI_DP_P, $dbs->getCulId(...))),
    ];
}

/** @param App<\Psr\Container\ContainerInterface|null> $app
 *
 * @return array<\Slim\Interfaces\RouteInterface> */
function init_query_cnt_v2(App $app, ConCtrl $ctrl_con): array
{
    $dbs = $ctrl_con->getDBSCtrlCnt();
    return [
        $app->get(QCntE::STR_CNT->value, pwr_cnt_v2(QCntE::STR_CNT, $dbs->getStrainCount(...))),
        $app->get(QCntE::ARC_CNT->value, pwr_cnt_v2(QCntE::ARC_CNT, $dbs->getArchiveCount(...))),
        $app->get(QCntE::STR_TYP_CNT->value, pwr_cnt_v2(QCntE::STR_TYP_CNT, $dbs->getTypeStrainCount(...))),
        $app->get(QCntE::DEP_SR_CNT->value, pwr_cnt_v2(QCntE::DEP_SR_CNT, $dbs->getTypeCultureCount(...))),
        $app->get(QCntE::DES_CNT->value, pwr_cnt_v2(QCntE::DES_CNT, $dbs->getDesignationCount(...))),
        $app->get(QCntE::SPE_CNT->value, pwr_cnt_v2(QCntE::SPE_CNT, $dbs->getSpeciesCount(...))),
        $app->get(QCntE::DEP_CNT->value, pwr_cnt_v2(QCntE::DEP_CNT, $dbs->getCultureCount(...))),
    ];
}
