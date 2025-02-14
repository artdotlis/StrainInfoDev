<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\view\routes;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\App;
use straininfo\server\mvvm\view\const\ConCtrl;
use straininfo\server\shared\mvvm\view\api\query\v1\QCntE;
use straininfo\server\shared\mvvm\view\api\query\v1\QCulE;
use straininfo\server\shared\mvvm\view\api\query\v1\QSeaCulIE;
use straininfo\server\shared\mvvm\view\api\query\v1\QSeaStrIE;
use straininfo\server\shared\mvvm\view\api\query\v1\QStrE;
use straininfo\server\shared\mvvm\view\api\VersionE;

/**
 * @param callable(QCntE,ServerRequestInterface, ResponseInterface): ResponseInterface $cb
 */
function pwr_cnt_v1(
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
 * @template T of QSeaStrIE|QSeaCulIE
 *
 * @param T $path
 * @param T $arg_name
 * @param callable(T,T,ServerRequestInterface, ResponseInterface, array<string>): ResponseInterface $cb
 */
function pwr_sea_v1(
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
 * @template T of QStrE|QCulE
 *
 * @param T $path
 * @param T $arg_name
 * @param callable(T, T, VersionE, ServerRequestInterface, ResponseInterface, array<string>): ResponseInterface $cb
 */
function pwr_dat_v1(
    $path,
    $arg_name,
    callable $cb
): callable {
    return static function (
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ) use ($path, $arg_name, $cb): ResponseInterface {
        return $cb($path, $arg_name, VersionE::V1, $request, $response, $args);
    };
}

/**
 * @param App<\Psr\Container\ContainerInterface|null> $app
 *
 * @return array<\Slim\Interfaces\RouteInterface>
 */
function init_query_cul_v1(App $app, ConCtrl $ctrl_con): array
{
    $dbs = $ctrl_con->getDBSCtrlCul();
    return [
        $app->get(QCulE::AVG->value, pwr_dat_v1(QCulE::AVG, QCulE::ID_P, $dbs->getAvg(...))),
        $app->get(QCulE::MAX->value, pwr_dat_v1(QCulE::MAX, QCulE::ID_P, $dbs->getMax(...))),
        $app->get(QCulE::MIN->value, pwr_dat_v1(QCulE::MIN, QCulE::ID_P, $dbs->getMin(...))),
    ];
}

/**
 * @param App<\Psr\Container\ContainerInterface|null> $app
 *
 * @return array<\Slim\Interfaces\RouteInterface>
 */
function init_query_str_v1(App $app, ConCtrl $ctrl_con): array
{
    $dbs = $ctrl_con->getDBSCtrlStr();
    return [
        $app->get(QStrE::AVG->value, pwr_dat_v1(QStrE::AVG, QStrE::ID_P, $dbs->getAvg(...))),
        $app->get(QStrE::MAX->value, pwr_dat_v1(QStrE::MAX, QStrE::ID_P, $dbs->getMax(...))),
        $app->get(QStrE::MIN->value, pwr_dat_v1(QStrE::MIN, QStrE::ID_P, $dbs->getMin(...))),
    ];
}

/** @param App<\Psr\Container\ContainerInterface|null> $app
 *
 * @return array<\Slim\Interfaces\RouteInterface> */
function init_query_sea_cul_v1(App $app, ConCtrl $ctrl_con): array
{
    $dbs = $ctrl_con->getDBSCtrlCulSea();
    return [
        $app->get(QSeaCulIE::SEQ_ACC->value, pwr_sea_v1(QSeaCulIE::SEQ_ACC, QSeaCulIE::SEQ_ACC_P, $dbs->getSeq(...))),
        $app->get(QSeaCulIE::STR_ID->value, pwr_sea_v1(QSeaCulIE::STR_ID, QSeaCulIE::STR_ID_P, $dbs->getStr(...))),
        $app->get(QSeaCulIE::TAX_NAME->value, pwr_sea_v1(QSeaCulIE::TAX_NAME, QSeaCulIE::TAX_NAME_P, $dbs->getTaxName(...))),
        $app->get(QSeaCulIE::STR_DES->value, pwr_sea_v1(QSeaCulIE::STR_DES, QSeaCulIE::STR_DES_P, $dbs->getStrDes(...))),
        $app->get(QSeaCulIE::STR_NO->value, pwr_sea_v1(QSeaCulIE::STR_NO, QSeaCulIE::STR_NO_P, $dbs->getStrNo(...))),
        $app->get(QSeaCulIE::BRC->value, pwr_sea_v1(QSeaCulIE::BRC, QSeaCulIE::BRC_P, $dbs->getBrc(...))),
    ];
}

/** @param App<\Psr\Container\ContainerInterface|null> $app
 *
 * @return array<\Slim\Interfaces\RouteInterface> */
function init_query_sea_str_v1(App $app, ConCtrl $ctrl_con): array
{
    $dbs = $ctrl_con->getDBSCtrlStrSea();
    return [
        $app->get(QSeaStrIE::SEQ_ACC->value, pwr_sea_v1(QSeaStrIE::SEQ_ACC, QSeaStrIE::SEQ_ACC_P, $dbs->getSeq(...))),
        $app->get(QSeaStrIE::TAX_NAME->value, pwr_sea_v1(QSeaStrIE::TAX_NAME, QSeaStrIE::TAX_NAME_P, $dbs->getTaxName(...))),
        $app->get(QSeaStrIE::STR_DES->value, pwr_sea_v1(QSeaStrIE::STR_DES, QSeaStrIE::STR_DES_P, $dbs->getStrDes(...))),
        $app->get(QSeaStrIE::STR_NO->value, pwr_sea_v1(QSeaStrIE::STR_NO, QSeaStrIE::STR_NO_P, $dbs->getStrNo(...))),
        $app->get(QSeaStrIE::BRC->value, pwr_sea_v1(QSeaStrIE::BRC, QSeaStrIE::BRC_P, $dbs->getBrc(...))),
        $app->get(QSeaStrIE::CUL_ID->value, pwr_sea_v1(QSeaStrIE::CUL_ID, QSeaStrIE::CUL_ID_P, $dbs->getCulId(...))),
    ];
}

/** @param App<\Psr\Container\ContainerInterface|null> $app
 *
 * @return array<\Slim\Interfaces\RouteInterface> */
function init_query_cnt_v1(App $app, ConCtrl $ctrl_con): array
{
    $dbs = $ctrl_con->getDBSCtrlCnt();
    return [
        $app->get(QCntE::STR_CNT->value, pwr_cnt_v1(QCntE::STR_CNT, $dbs->getStrainCount(...))),
        $app->get(QCntE::ARC_CNT->value, pwr_cnt_v1(QCntE::ARC_CNT, $dbs->getArchiveCount(...))),
        $app->get(QCntE::STR_TYP_CNT->value, pwr_cnt_v1(QCntE::STR_TYP_CNT, $dbs->getTypeStrainCount(...))),
        $app->get(QCntE::CUL_TYP_CNT->value, pwr_cnt_v1(QCntE::CUL_TYP_CNT, $dbs->getTypeCultureCount(...))),
        $app->get(QCntE::DES_CNT->value, pwr_cnt_v1(QCntE::DES_CNT, $dbs->getDesignationCount(...))),
        $app->get(QCntE::SPE_CNT->value, pwr_cnt_v1(QCntE::SPE_CNT, $dbs->getSpeciesCount(...))),
        $app->get(QCntE::CUL_CNT->value, pwr_cnt_v1(QCntE::CUL_CNT, $dbs->getCultureCount(...))),
    ];
}
