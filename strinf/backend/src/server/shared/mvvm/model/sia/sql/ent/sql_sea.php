<?php

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\model\sia\sql\ent;

use straininfo\server\shared\mvvm\model\sia\fields\DBStructStrE;
use straininfo\server\shared\mvvm\model\sia\fields\DBStructDesE;
use straininfo\server\shared\mvvm\model\sia\fields\DBStructCulE;

use function straininfo\server\shared\mvvm\model\sia\sql\get_cul_not_err;
use function straininfo\server\shared\mvvm\model\sia\sql\get_col_not_err;
use function straininfo\server\shared\mvvm\model\sia\sql\create_sql_in_tuple_templ;
use function straininfo\server\shared\mvvm\model\sia\sql\create_sql_in_templ;

/** @return array<string> */
function create_sql_designation_triplet(int $cntPart): array
{
    if ($cntPart === 0) {
        return [];
    }
    return [
        ' OR ',
        create_sql_in_tuple_templ($cntPart, [
            'designation.prefix',
            'designation.core',
            'designation.suffix',
        ]),
    ];
}

function get_designation(int $cntDes, int $cntPart): string
{
    $str_des = create_sql_in_templ(
        $cntDes,
        ['designation.designation'],
        ''
    );
    $str_tri = implode(' ', create_sql_designation_triplet($cntPart));
    $des = DBStructDesE::DES_ID->value;
    return <<<EOF
    SELECT DISTINCT designation.id as {$des}
    FROM designation
    WHERE {$str_des} {$str_tri};
    EOF;
}

function get_cul_base(): string
{
    $cui = DBStructCulE::CULTURE_ID->value;
    return <<<EOF
    SELECT DISTINCT culture.id as {$cui}
    FROM strain
        INNER JOIN culture
            ON strain.id=culture.strain_id
    EOF;
}

function get_str_base(): string
{
    $sain = DBStructStrE::MAIN_ID->value;
    return <<<EOF
    SELECT DISTINCT strain.main_id as {$sain}
    FROM strain
        INNER JOIN culture
            ON strain.id=culture.strain_id
    EOF;
}

function get_str_cul(string $slimBase): string
{
    return <<<EOF
        {$slimBase}
        LEFT JOIN culture_collection_number
            ON culture.ccno_id=culture_collection_number.id
        LEFT JOIN culture_collection
                ON culture_collection.id=culture_collection_number.brc_id
    EOF;
}

function get_str_no(string $slimBase): string
{
    $cul = get_cul_not_err();
    $col = get_col_not_err();
    return get_str_cul($slimBase) . <<<EOF
        INNER JOIN designation
            ON designation.id=culture.designation_id
        WHERE {$cul} AND {$col}
    EOF;
}

function get_brc(string $slimBase): string
{
    $cul = get_cul_not_err();
    $col = get_col_not_err();
    return get_str_cul($slimBase) . <<<EOF
        WHERE {$cul} AND {$col}
    EOF;
}

function get_seq(string $slimBase): string
{
    $cul = get_cul_not_err();
    $col = get_col_not_err();
    return <<<EOF
        {$slimBase}
        INNER JOIN sequenced_strain
            ON sequenced_strain.des_id=culture.designation_id
        INNER JOIN sequence
            ON sequenced_strain.seq_id=sequence.id
        LEFT JOIN culture_collection_number
            ON culture.ccno_id=culture_collection_number.id
        LEFT JOIN culture_collection
                ON culture_collection.id=culture_collection_number.brc_id
        WHERE {$cul} AND {$col}
    EOF;
}

function get_sea_brc_ent(int $cnt, string $slimBase): string
{
    return implode('', [
        get_brc($slimBase),
        ' AND (',
        create_sql_in_templ($cnt, ['culture_collection.acr'], ''),
        ' OR ',
        create_sql_in_templ($cnt, ['culture_collection.code_acr'], ''),
        ');',
    ]);
}

function get_sea_tax_name_ent(string $table, string $slimBase): string
{
    $cul = get_cul_not_err();
    $col = get_col_not_err();
    return get_str_cul($slimBase) . <<<EOF
        INNER JOIN taxon_name
            ON {$table}.tax_id=taxon_name.id
        WHERE {$cul} AND {$col}
            AND taxon_name.name_canonical=?
        GROUP BY strain.main_id
        ORDER BY COUNT(culture.id) DESC;
    EOF;
}

/** @return array<string> */
function get_sea_des_ent(int $cnt, string $slimBase): array
{
    $des_id = create_sql_in_templ($cnt, ['culture.designation_id'], '');
    $dep_id = create_sql_in_templ($cnt, ['culture_collection_number.dep_des_id'], '');
    $rel_id = create_sql_in_templ($cnt, ['culture_relation.des_id'], '');
    $cul = get_cul_not_err();
    $col = get_col_not_err();
    $cond = <<<EOF
        LEFT JOIN culture_collection_number
            ON culture.ccno_id=culture_collection_number.id
        LEFT JOIN culture_collection
            ON culture_collection.id=culture_collection_number.brc_id
        WHERE {$cul} AND {$col} 
    EOF;
    return [
        "{$slimBase} {$cond} AND {$des_id};",
        "{$slimBase} {$cond} AND {$dep_id};",
        "{$slimBase} " . <<<EOF
        INNER JOIN culture_relation
            ON culture_relation.cul_id=culture.id AND {$rel_id};
        EOF . " {$cond};",
    ];
}

function get_sea_str_id_cul(int $cnt): string
{
    return implode('', [
        get_cul_base(),
        ' WHERE ',
        create_sql_in_templ($cnt, ['strain.id'], ''),
        ';',
    ]);
}

function get_sea_str_no_ent(int $cntDes, int $cntPart, string $slimBase): string
{
    return implode('', [
        get_str_no($slimBase),
        ' AND (',
        create_sql_in_templ($cntDes, ['designation.designation'], ''),
        ...create_sql_designation_triplet($cntPart),
        ');',
    ]);
}

function get_sea_cul_id_str(int $cnt): string
{
    return implode('', [
        get_str_base(),
        ' WHERE ',
        create_sql_in_templ($cnt, ['culture.id'], ''),
        ';',
    ]);
}

function get_sea_seq_acc_ent(int $cnt, string $slimBase): string
{
    return implode('', [
        get_seq($slimBase),
        ' AND ',
        create_sql_in_templ(
            $cnt,
            ['sequence.accession_number'],
            ''
        ),
        ';',
    ]);
}
