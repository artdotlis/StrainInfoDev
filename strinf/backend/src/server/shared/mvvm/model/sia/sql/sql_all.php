<?php

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\model\sia\sql;

function get_all_cul(): string
{
    $cul = get_cul_not_err();
    $col = get_col_not_err();
    return <<<EOF
    SELECT DISTINCT culture.id
    FROM culture
        LEFT JOIN culture_collection_number
            ON culture.ccno_id=culture_collection_number.id
        LEFT JOIN culture_collection
            ON culture_collection.id=culture_collection_number.brc_id
    WHERE {$cul} AND {$col};
    EOF;
}

function get_all_str(): string
{
    $cul = get_cul_not_err();
    $col = get_col_not_err();
    return <<<EOF
    SELECT DISTINCT strain.main_id
    FROM strain
        INNER JOIN culture
            ON strain.id=culture.strain_id
        LEFT JOIN culture_collection_number
            ON culture.ccno_id=culture_collection_number.id
        LEFT JOIN culture_collection
            ON culture_collection.id=culture_collection_number.brc_id
    WHERE {$cul} AND {$col};
    EOF;
}

function get_all_t_str(): string
{
    $cul = get_cul_not_err();
    $col = get_col_not_err();
    return <<<EOF
    SELECT DISTINCT strain.main_id
    FROM strain
        INNER JOIN culture
            ON strain.id=culture.strain_id
        LEFT JOIN culture_collection_number
            ON culture.ccno_id=culture_collection_number.id
        LEFT JOIN culture_collection
            ON culture_collection.id=culture_collection_number.brc_id
    WHERE strain.type_strain = 1 AND {$cul} AND {$col};
    EOF;
}

function get_all_t_cul(): string
{
    $cul = get_cul_not_err();
    return <<<EOF
    SELECT DISTINCT culture.id
    FROM culture
    WHERE {$cul} AND culture.type_culture=1;
    EOF;
}
