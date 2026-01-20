<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\model\sia\sql\cul;

use straininfo\server\shared\mvvm\model\sia\fields\DBStructBrcE;
use straininfo\server\shared\mvvm\model\sia\fields\DBStructCulE;
use straininfo\server\shared\mvvm\model\sia\fields\DBStructSubE;
use straininfo\server\shared\mvvm\model\sia\fields\DBStructTaxE;

function get_sql_select_cul_min(): string
{
    $cui = DBStructCulE::CULTURE_ID->value;
    $str = DBStructCulE::STRAIN_NUMBER->value;
    $cat = DBStructCulE::CAT->value;
    $con = DBStructCulE::CAT_ON->value;
    $sta = DBStructCulE::STATUS->value;
    $cty = DBStructCulE::TYP_CUL->value;
    $cts = DBStructCulE::TYP_STR->value;
    $dsr = DBStructCulE::DATA_SRC->value;
    $cid = DBStructCulE::CCNO_ID->value;
    $upd = DBStructCulE::UPDATE->value;
    $reg = DBStructCulE::REG_DATE->value;
    $tan = DBStructTaxE::C_NAME->value;
    $ncbi = DBStructTaxE::C_NCBI->value;
    $lpsn = DBStructTaxE::C_LPSN->value;
    $bid = DBStructBrcE::B_ID->value;
    $bna = DBStructBrcE::B_NAME->value;
    $bco = DBStructBrcE::B_CODE->value;
    $bde = DBStructBrcE::B_DEPR->value;
    return <<<EOF
    SELECT DISTINCT
        culture.id as {$cui},
        designation.designation as {$str},
        culture_collection_number.catalogue as {$cat},
        culture_collection_number.online as {$con},
        culture.status as {$sta},
        culture.type_culture as {$cty},
        culture_collection_number.type_strain as {$cts},
        culture_collection_number.data_source as {$dsr},
        culture.ccno_id as {$cid},
        c_taxon_name.name_canonical as {$tan},
        c_taxon_name.ncbi_id as {$ncbi},
        c_taxon_name.lpsn_id as {$lpsn},
        culture.reg_date as {$reg},
        culture_collection.id as {$bid},
        culture_collection.name as {$bna},
        culture_collection.code_acr as {$bco},
        culture_collection.deprecated as {$bde},
        culture.last_update as {$upd}
    EOF;
}

function get_sql_from_cul_min(): string
{
    return <<<EOF
    FROM culture
        INNER JOIN designation
            ON designation.id=culture.designation_id
        LEFT JOIN culture_collection_number
            ON culture.ccno_id=culture_collection_number.id        
        LEFT JOIN culture_collection
            ON culture_collection_number.brc_id = culture_collection.id
        LEFT JOIN taxon_name as c_taxon_name
            ON c_taxon_name.id = culture.tax_id         
    EOF;
}

function get_sql_from_str_cul_min(): string
{
    return <<<EOF
    FROM strain
        INNER JOIN culture
            ON culture.strain_id=strain.id
        INNER JOIN designation
            ON designation.id=culture.designation_id
        LEFT JOIN culture_collection_number
            ON culture.ccno_id=culture_collection_number.id
        LEFT JOIN culture_collection
            ON culture_collection_number.brc_id = culture_collection.id
        LEFT JOIN taxon_name as c_taxon_name
            ON c_taxon_name.id = culture.tax_id         
    EOF;
}

function get_sql_cul_min(): string
{
    return get_sql_select_cul_min() . ' ' . get_sql_from_cul_min();
}

/** @return array<string> */
function get_cul_id_min(): array
{
    return [
        get_sql_cul_min() . ' WHERE culture.id=?;',
        get_sql_entity(DBStructSubE::class) . ' WHERE culture.id=?;',
    ];
}

function get_cul_min_str_id(): string
{
    return get_sql_select_cul_min() . ' ' .
    get_sql_from_str_cul_min() . ' WHERE strain.main_id=?;';
}

function get_cul_min_reg_id(): string
{
    return get_sql_entity_str(DBStructSubE::class) . ' WHERE strain.main_id=?;';
}
