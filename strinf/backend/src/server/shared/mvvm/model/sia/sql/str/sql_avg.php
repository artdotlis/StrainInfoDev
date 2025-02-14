<?php

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\model\sia\sql\str;

use straininfo\server\shared\mvvm\model\sia\fields\DBStructArcE;
use straininfo\server\shared\mvvm\model\sia\fields\DBStructDesE;
use straininfo\server\shared\mvvm\model\sia\fields\DBStructSeqE;
use straininfo\server\shared\mvvm\model\sia\fields\DBStructStrE;

use function straininfo\server\shared\mvvm\model\sia\sql\get_col_not_err;
use function straininfo\server\shared\mvvm\model\sia\sql\get_cul_not_err;

function get_sql_strain_status(): string
{
    $sta = DBStructStrE::STR_STA_ON->value;
    return <<<EOF
        SELECT COUNT(culture.id) as {$sta}
        FROM strain
            INNER JOIN culture
                ON culture.strain_id=strain.id
            INNER JOIN culture_collection_number
                ON culture.ccno_id=culture_collection_number.id
        WHERE culture_collection_number.online=1 AND strain.main_id=?;
    EOF;
}

function get_sql_arc(): string
{
    $doi = DBStructArcE::DOI->value;
    $arc = DBStructArcE::DATE->value;
    $tit = DBStructArcE::TIT->value;
    return <<<EOF
    SELECT DISTINCT 
        strain_archive.doi as {$doi},
        strain_archive.archived as {$arc},
        strain_archive.title as {$tit}
    FROM strain_archive
    EOF;
}

function get_main_str_con(string $sql): string
{
    $cul = get_cul_not_err();
    $col = get_col_not_err();
    return <<<EOF
    {$sql} 
    WHERE strain.main_id=? AND {$cul} AND {$col};
    EOF;
}

function get_sql_seq(): string
{
    $sid = DBStructSeqE::SEQ_ID->value;
    $acc = DBStructSeqE::ACC_NR->value;
    $len = DBStructSeqE::SEQ_L->value;
    $desc = DBStructSeqE::DESC->value;
    $yea = DBStructSeqE::YEAR->value;

    $typ = DBStructSeqE::TYP->value;
    $ass = DBStructSeqE::ASS->value;

    $cid = DBStructSeqE::CUL->value;
    $cde = DBStructSeqE::CUL_DES->value;
    return <<<EOF
    SELECT DISTINCT 
        sequence.id as {$sid},
        sequence.accession_number as {$acc},
        sequence.length as {$len},
        sequence.description as {$desc},
        sequence.year as {$yea},
        sequence.type as {$typ},
        sequence.assembly_level as {$ass},
        culture.id as {$cid},
        designation.designation as {$cde}
    FROM strain
        INNER JOIN culture
            ON culture.strain_id = strain.id
        INNER JOIN designation
            ON culture.designation_id = designation.id
        INNER JOIN sequenced_strain
            ON designation.id = sequenced_strain.des_id
        INNER JOIN sequence
            ON sequence.id = sequenced_strain.seq_id
        LEFT JOIN culture_collection_number
            ON culture.ccno_id=culture_collection_number.id
        LEFT JOIN culture_collection
            ON culture_collection.id=culture_collection_number.brc_id
    EOF;
}

function get_rel_des(): string
{
    $des = DBStructDesE::DES->value;
    return <<<EOF
    SELECT DISTINCT designation.designation as {$des}
    FROM strain
        INNER JOIN culture
            ON culture.strain_id = strain.id
        INNER JOIN culture_relation as des_rel
            ON des_rel.cul_id = culture.id
        INNER JOIN designation
            ON des_rel.des_id=designation.id AND 
            designation.id NOT IN (
                SELECT DISTINCT str_cul.designation_id
                FROM strain as loc_str
                    INNER JOIN culture as str_cul
                        ON loc_str.id=str_cul.strain_id
                WHERE loc_str.main_id=?
            )
        LEFT JOIN culture_collection_number
            ON culture.ccno_id=culture_collection_number.id
        LEFT JOIN culture_collection
            ON culture_collection.id=culture_collection_number.brc_id    
    WHERE strain.main_id=?;
    EOF;
}

function get_alt_si_id(): string
{
    $alt = DBStructStrE::ALT_ID->value;
    return <<<EOF
    SELECT DISTINCT alternative_strain.alt_id as {$alt}
    FROM alternative_strain   
    WHERE alternative_strain.id=?;
    EOF;
}

function get_archive(): string
{
    $sql = get_sql_arc();
    return <<<EOF
    {$sql}
    WHERE strain_archive.str_id IN(
        SELECT DISTINCT strain.id
        FROM strain
        WHERE strain.main_id=?
    ); 
    EOF;
}
