<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\model\sia\sql\cul;

use straininfo\server\shared\mvvm\model\sia\fields\DBStructSupE;
use straininfo\server\shared\mvvm\model\sia\fields\DBStructSubE;
use straininfo\server\shared\mvvm\model\sia\fields\DBStructStrE;
use straininfo\server\shared\mvvm\model\sia\fields\DBStructIsoE;
use straininfo\server\shared\mvvm\model\sia\fields\DBStructDesE;
use straininfo\server\shared\mvvm\model\sia\fields\DBStructDepE;
use straininfo\server\shared\mvvm\model\sia\fields\DBStructCulE;
use straininfo\server\shared\mvvm\model\sia\fields\DBStructBrcE;

/**
 * @param class-string<DBStructSupE|DBStructSubE> $type
 */
function get_sql_entity_base(string $type): string
{
    $nam = $type::NAME->value;
    $ins = $type::INST->value;
    $ror = $type::ROR->value;
    $orcid = $type::ORCID->value;
    $pla = $type::PLA->value;
    $rcc = $type::RCC->value;
    return <<<EOF
    SELECT DISTINCT
        entity.name as {$nam},
        entity.institute as {$ins},
        entity.ror as {$ror},
        entity.orcid as {$orcid},
        sub_loc.place as {$pla},
        sub_loc.country_code as {$rcc}
    EOF;
}

/**
 * @param class-string<DBStructSupE|DBStructSubE> $type
 */
function get_sql_entity(string $type): string
{
    $base = get_sql_entity_base($type);
    $typ_str = $type::TYPE->value;
    return <<<EOF
    {$base}
    FROM culture
        LEFT JOIN entity as entity
            ON entity.cul_id = culture.id AND entity.type = '{$typ_str}'
        LEFT JOIN location as sub_loc
            ON entity.loc_id = sub_loc.id 
    EOF;
}

/**
 * @param class-string<DBStructSupE|DBStructSubE> $type
 */
function get_sql_entity_str(string $type): string
{
    $base = get_sql_entity_base($type);
    $cui = DBStructCulE::CULTURE_ID->value;
    $reg = DBStructCulE::REG_DATE->value;
    $typ_str = $type::TYPE->value;
    return <<<EOF
    {$base},
    culture.id as {$cui},
    culture.reg_date as {$reg}
    FROM strain
        INNER JOIN culture
            ON strain.id=culture.strain_id
        LEFT JOIN entity as entity
            ON entity.cul_id = culture.id AND entity.type = '{$typ_str}'
        LEFT JOIN location as sub_loc
            ON entity.loc_id = sub_loc.id 
    EOF;
}

function get_sql_depositor(): string
{
    $dna = DBStructDepE::NAME->value;
    $din = DBStructDepE::INST->value;
    $dcc = DBStructDepE::DCC->value;
    $dpl = DBStructDepE::PLA->value;
    $dro = DBStructDepE::ROR->value;
    $dor = DBStructDepE::ORCID->value;
    $con = DBStructDepE::CONTR->value;
    return <<<EOF
    SELECT DISTINCT
        depositor.name as {$dna},
        depositor.institute as {$din},
        depositor.ror as {$dro},
        depositor.orcid as {$dor},
        dep_loc.place as {$dpl},
        dep_loc.country_code as {$dcc},
        depositor.type = 'contributor [deposition]' as {$con}
    FROM culture
        LEFT JOIN entity as depositor
            ON depositor.cul_id = culture.id  AND depositor.type IN(
                'depositor', 'contributor [deposition]'
            ) 
        LEFT JOIN location as dep_loc
            ON depositor.loc_id = dep_loc.id 
    EOF;
}

function get_sql_isolator(): string
{
    $ina = DBStructIsoE::NAME->value;
    $iin = DBStructIsoE::INST->value;
    $iro = DBStructIsoE::ROR->value;
    $ior = DBStructIsoE::ORCID->value;
    $ipl = DBStructIsoE::PLA->value;
    $icc = DBStructIsoE::DCC->value;
    $ico = DBStructIsoE::CONTR->value;
    return <<<EOF
    SELECT DISTINCT
        isolator.name as {$ina},
        isolator.institute as {$iin},
        isolator.ror as {$iro},
        isolator.orcid as {$ior},
        iso_loc.place as {$ipl},
        iso_loc.country_code as {$icc},
        isolator.type = 'contributor [isolation]' as {$ico}
    FROM culture
        LEFT JOIN entity as isolator
            ON isolator.cul_id = culture.id  AND isolator.type IN(
                'isolator', 'contributor [isolation]'
            ) 
        LEFT JOIN location as iso_loc
            ON isolator.loc_id = iso_loc.id 
    EOF;
}

function get_sql_select_cul_avg(): string
{
    $bcc = DBStructBrcE::B_CC->value;
    $bro = DBStructBrcE::B_ROR->value;
    $bac = DBStructBrcE::B_ACT->value;
    $bde = DBStructBrcE::B_DEPR->value;
    $bgi = DBStructBrcE::B_GBIF->value;
    $bho = DBStructBrcE::B_HOME->value;
    $bon = DBStructBrcE::B_ON->value;
    $com = DBStructCulE::COMMENT->value;
    $his = DBStructCulE::HIST->value;
    $bac_id = DBStructCulE::BAC_DIVE->value;
    $dde = DBStructDepE::DES->value;
    $ddo = DBStructDepE::ORI_CUL->value;
    $dye = DBStructDepE::YEAR->value;
    $iye = DBStructIsoE::YEAR->value;
    $sas = DBStructIsoE::SAM_SRC->value;
    $scc = DBStructIsoE::SAM_CC->value;
    $sda = DBStructIsoE::SAM_DATE->value;
    $spl = DBStructIsoE::SAM_PLA->value;
    $sain = DBStructStrE::MAIN_ID->value;
    return get_sql_select_cul_min() . <<<EOF
    , strain.main_id as {$sain}
    , culture.comment as {$com}
    , culture_collection_number.history as {$his}
    , (
        SELECT GROUP_CONCAT(culture_bac_dive.bac_dive_id SEPARATOR ',')
        FROM culture_bac_dive
        WHERE culture_bac_dive.cul_id = culture.id
    ) as {$bac_id}
    , culture_collection.country as {$bcc}
    , culture_collection.ror as {$bro}
    , culture_collection.active as {$bac}
    , culture_collection.deprecated as {$bde}
    , culture_collection.gbif as {$bgi}
    , culture_collection.homepage as {$bho}
    , culture_collection.online as {$bon}
    , deposition.designation as {$dde}
    , culture_collection_number.dep_cul_id as {$ddo}
    , culture_collection_number.dep_year as {$dye}
    , culture.iso_year as {$iye}
    , culture.sam_date as {$sda}
    , sample.source as {$sas}
    , sample_loc.country_code as {$scc}
    , sample_loc.place as {$spl}
    EOF;
}

function get_sql_from_cul_avg(): string
{
    return get_sql_from_cul_min() . ' ' . <<<EOF
        INNER JOIN strain
            ON strain.id=culture.strain_id
        LEFT JOIN designation as deposition
            ON deposition.id=culture_collection_number.dep_des_id
        LEFT JOIN sample
            ON sample.id=culture.sam_id
        LEFT JOIN location as sample_loc
            ON sample_loc.id=culture.sam_loc_id
    EOF;
}

function get_sql_cul_rel_des(): string
{
    $des = DBStructDesE::DES->value;
    return <<<EOF
        SELECT DISTINCT designation.designation as {$des}
        FROM culture_relation
            INNER JOIN designation
                ON culture_relation.des_id=designation.id
        WHERE culture_relation.cul_id=?;
    EOF;
}

function get_sql_cul_avg(): string
{
    return get_sql_select_cul_avg() . ' ' . get_sql_from_cul_avg();
}

/** @return array<string> */
function get_cul_id_avg(): array
{
    return [
        get_sql_cul_avg() . ' WHERE culture.id=?;',
        get_sql_entity(DBStructSubE::class) . ' WHERE culture.id=?;',
        get_sql_depositor() . ' WHERE culture.id=?;',
        get_sql_isolator() . ' WHERE culture.id=?;',
        get_sql_entity(DBStructSupE::class) . ' WHERE culture.id=?;',
        get_sql_cul_rel_des(),
    ];
}
