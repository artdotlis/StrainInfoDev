<?php

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\view\api;

use straininfo\server\shared\mvvm\view\api\query\service\QAllE;
use straininfo\server\shared\mvvm\view\api\query\service\QArcE;
use straininfo\server\shared\mvvm\view\api\query\service\QOptSeaE;
use straininfo\server\shared\mvvm\view\api\query\service\QStatE;
use straininfo\server\shared\mvvm\view\api\query\v1\QCntE as QCntEV1;
use straininfo\server\shared\mvvm\view\api\query\v1\QCulE as QCulEV1;
use straininfo\server\shared\mvvm\view\api\query\v1\QSeaCulIE as QSeaCulIEV1;
use straininfo\server\shared\mvvm\view\api\query\v1\QSeaStrIE as QSeaStrIEV1;
use straininfo\server\shared\mvvm\view\api\query\v1\QStrE as QStrEV1;
use straininfo\server\shared\mvvm\view\api\query\v2\QCntE as QCntEV2;
use straininfo\server\shared\mvvm\view\api\query\v2\QDepE as QDepEV2;
use straininfo\server\shared\mvvm\view\api\query\v2\QSeaDepIE as QSeaDepIEV2;
use straininfo\server\shared\mvvm\view\api\query\v2\QSeaStrIE as QSeaStrIEV2;
use straininfo\server\shared\mvvm\view\api\query\v2\QStrE as QStrEV2;

function is_cnt_api_pr(QCntEV1 | QCntEV2 $api): bool
{
    $pr_api = get_cnt_api_pr();
    return in_array($api->value, $pr_api);
}

/** @return array<string> */
function get_cnt_api_pr(): array
{
    return [];
}

function is_all_api_pr(QAllE $api): bool
{
    $pr_api = get_all_api_pr();
    return in_array($api->value, $pr_api);
}

/** @return array<string> */
function get_all_api_pr(): array
{
    return [];
}

function is_cul_api_pr(QDepEV2 | QCulEV1 $api): bool
{
    $pr_api = get_cul_api_pr();
    return in_array($api->value, $pr_api);
}

/** @return array<string> */
function get_arc_api_pr(): array
{
    return [];
}

function is_str_api_pr(QStrEV1 | QStrEV2 $api): bool
{
    $pr_api = get_str_api_pr();
    return in_array($api->value, $pr_api);
}

/** @return array<string> */
function get_str_api_pr(): array
{
    return [];
}

function is_arc_api_pr(QArcE $api): bool
{
    $pr_api = get_arc_api_pr();
    return in_array($api->value, $pr_api);
}

/** @return array<string> */
function get_cul_api_pr(): array
{
    return [];
}

function is_stat_api_pr(QStatE $api): bool
{
    $pr_api = get_stat_api_pr();
    return in_array($api->value, $pr_api);
}

/** @return array<string> */
function get_stat_api_pr(): array
{
    return [];
}

function is_sea_cul_api_pr(QSeaCulIEV1 | QSeaDepIEV2 $api): bool
{
    $pr_api = get_sea_cul_api_pr();
    return in_array($api->value, $pr_api);
}

/** @return array<string> */
function get_sea_cul_api_pr(): array
{
    return [];
}

function is_sea_str_api_pr(QSeaStrIEV1 | QSeaStrIEV2 $api): bool
{
    $pr_api = get_sea_str_api_pr();
    return in_array($api->value, $pr_api);
}

/** @return array<string> */
function get_sea_str_api_pr(): array
{
    return [];
}

function is_sea_opt_api_pr(QOptSeaE $api): bool
{
    $pr_api = get_sea_opt_api_pr();
    return in_array($api->value, $pr_api);
}

/** @return array<string> */
function get_sea_opt_api_pr(): array
{
    return [];
}

function get_do_not_track_arg(): string
{
    return 'do_not_track';
}

function get_short_arg(): string
{
    return 'short';
}
