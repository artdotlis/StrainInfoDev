<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\controller\const;

use straininfo\server\interfaces\mvvm\view_model\chan\cache\CaVMIntAll;
use straininfo\server\interfaces\mvvm\view_model\chan\cache\CaVMIntArc;
use straininfo\server\interfaces\mvvm\view_model\chan\cache\CaVMIntCnt;
use straininfo\server\interfaces\mvvm\view_model\chan\cache\CaVMIntDat;
use straininfo\server\interfaces\mvvm\view_model\chan\cache\CaVMIntStat;
use straininfo\server\interfaces\mvvm\view_model\chan\index\InVMIntSea;
use straininfo\server\interfaces\mvvm\view_model\chan\query\QVMIntAll;
use straininfo\server\interfaces\mvvm\view_model\chan\query\QVMIntArc;
use straininfo\server\interfaces\mvvm\view_model\chan\query\QVMIntCnt;
use straininfo\server\interfaces\mvvm\view_model\chan\query\QVMIntDat;
use straininfo\server\interfaces\mvvm\view_model\chan\query\QVMIntStat;
use straininfo\server\interfaces\mvvm\view_model\chan\search\VMIntSeaOpt;
use function straininfo\server\shared\arr\count_2d_arr;
use straininfo\server\shared\mvvm\view\api\VersionE;

use straininfo\server\shared\mvvm\view_model\data\QDConIdEnt;

/**
 * @template T of string|int
 *
 * @param ConQGetSId<T> $cha
 *
 * @return array{string, bool}
 */
function search_ent_id(string $sid, ConQGetSId $cha): array
{
    $args = $cha->getQS()->parseArg($sid);
    if (count($args) === 0) {
        return [$cha->getQS()->createJson([]), true];
    }
    $c_sea = $cha->getBS()->getResult($args);
    if ($c_sea->getMisIds()) {
        $c_sea->setToBuf($cha->getQS()->getResult($c_sea->getMisIds()));
    }
    $cha->getBS()->setResult($c_sea);
    return [$cha->getQS()->createJson($c_sea->getRes()), count($c_sea->getRes()) === 0];
}

/**
 * @template TV of \straininfo\server\shared\mvvm\view_model\data\ParCul|\straininfo\server\shared\mvvm\view_model\data\ParStr
 *
 * @param array<int> $si_ids
 * @param QVMIntDat<TV> $cha_q
 *
 * @return QDConIdEnt<int>
 */
function get_ent_by_ids(
    VersionE $version,
    array $si_ids,
    QVMIntDat $cha_q,
    CaVMIntDat $cha_b
): QDConIdEnt {
    if (count($si_ids) === 0) {
        return new QDConIdEnt([], []);
    }
    $con = $cha_b->getResult($si_ids, $version);
    if ($con->getMisIds()) {
        $start = microtime(true);
        $con->addToBuf(
            $cha_q->createJsonList(
                $cha_q->getResult($con->getMisIds(), $version)
            )
        );
        $work = microtime(true) - $start;
        $perm = (count($con->getMisIds()) === 1
            && $work > 400) || $cha_b->permanent($version);
        $cha_b->setResult($con, $version, $perm);
    }
    return $con;
}

/**
 * @param QVMIntDat<\straininfo\server\shared\mvvm\view_model\data\ParCul|\straininfo\server\shared\mvvm\view_model\data\ParStr> $cha_q
 *
 * @return array{string, bool}
 */
function get_ent_by_id(
    VersionE $version,
    string $id,
    QVMIntDat $cha_q,
    CaVMIntDat $cha_b
): array {
    $con = get_ent_by_ids($version, $cha_q->parseArg($id), $cha_q, $cha_b);
    return [$cha_q->createJson($con->getRes()), count($con->getRes()) === 0];
}

/** @return array{string, bool} */
function get_arc_by_si_id(string $id, QVMIntArc $cha_q, CaVMIntArc $cha_b): array
{
    $args = $cha_q->parseArg($id);
    $con = $cha_b->getResult($args);
    if (count($args) === 0) {
        return [$cha_q->createJson([]), true];
    }
    if ($con->getMisIds()) {
        $con->addToBuf($cha_q->getResult($con->getMisIds()));
        $cha_b->setResult($con);
    }
    return [$cha_q->createJson($con->getRes()), count($con->getRes()) === 0];
}

function get_all_id(QVMIntAll $cha_q, CaVMIntAll $cha_b): string
{
    $con = $cha_b->getResult();
    if (!$con->isBuffered()) {
        $buf = $cha_q->getResult();
        $con->setCnt(count($buf));
        $con->setJson($cha_q->createJson($buf));
        $cha_b->setResult($con);
    }
    return $con->getJson();
}

/**
 * @template T
 *
 * @param QVMIntStat<T> $cha_q
 */
function get_stat_2d(QVMIntStat $cha_q, CaVMIntStat $cha_b): string
{
    $con = $cha_b->getResult();
    if (!$con->isBuffered()) {
        $buf = $cha_q->getResult();
        $con->setCnt(count_2d_arr($buf));
        $con->setJson($cha_q->createJson($buf));
        $cha_b->setResult($con);
    }
    return $con->getJson();
}

function get_count(QVMIntCnt $cha_q, CaVMIntCnt $cha_b): string
{
    $con = $cha_b->getCount();
    if (!$con->isBuffered()) {
        $con->setToBuf($cha_q->getCount());
        $cha_b->setCount($con);
    }
    $con->setJson($cha_q->createJson($con->getCnt()));
    return $con->getJson();
}

/** @return array{string, bool} */
function sea_index_term(string $term, InVMIntSea $cha): array
{
    $arg = $cha->parseArg($term);
    $con = $cha->getResult($arg);
    return $cha->createJson($con);
}

/**
 * @param \straininfo\server\interfaces\mvvm\view_model\chan\query\QVMIntDat<\straininfo\server\shared\mvvm\view_model\data\ParStr> $sea_q
 *
 * @return array{string, bool}
 */
function sea_mic(
    string $si_id,
    QVMIntDat $sea_q,
    CaVMIntDat $ca_min,
    CaVMIntDat $ca_mic,
    VMIntSeaOpt $sea_opt
): array {
    $si_ids = $sea_q->parseArg($si_id);
    $con_ca = $ca_mic->getResult($si_ids, VersionE::V2);
    if (!$con_ca->getMisIds() && $con_ca->getRes()) {
        return $sea_opt->createMicJson($con_ca->getRes());
    }
    $con = get_ent_by_ids(VersionE::V2, $si_ids, $sea_q, $ca_min);
    $con_ca->addToBuf($con->getRes());
    $ca_mic->setResult($con_ca, VersionE::V2, false);
    return $sea_opt->createMicJson($con->getRes());
}

/**
 * @param \straininfo\server\interfaces\mvvm\view_model\chan\query\QVMIntDat<\straininfo\server\shared\mvvm\view_model\data\ParStr> $sea_q
 *
 * @return array{string, bool}
 */
function sea_mic_all(
    int $index,
    QVMIntAll $q_all,
    CaVMIntAll $b_all,
    QVMIntDat $sea_q,
    CaVMIntDat $sea_b,
    CaVMIntDat $ca_mic_ind,
    VMIntSeaOpt $sea_opt
): array {
    $all_ids = $q_all->parseJson(get_all_id($q_all, $b_all));
    $db_size = count($all_ids);
    $size = (int) ($db_size / 5);
    $pos = $index * $size;
    $con_ca = $ca_mic_ind->getResult([$index], VersionE::V2);
    if (!$con_ca->getMisIds() && $con_ca->getRes()) {
        return [$con_ca->getRes()[$index], $pos >= $db_size || $pos < 0];
    }
    $si_ids = array_slice($all_ids, $pos, $size);
    $con = get_ent_by_ids(VersionE::V2, $si_ids, $sea_q, $sea_b);
    $next_pos = $pos + count($si_ids);
    $no_next = $next_pos >= $db_size || $next_pos < 0;
    $res_json = $sea_opt->createMicAllJson(
        $con->getRes(),
        $no_next ? -1 : $index + 1,
        $db_size
    );
    $con_ca->addToBuf([$index => $res_json]);
    if (count($con->getRes()) === count($si_ids)) {
        $ca_mic_ind->setResult($con_ca, VersionE::V2, false);
    }
    return [
        $res_json,
        $pos >= $db_size || $pos < 0,
    ];
}
