<?php

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\model\sia\sql;

function get_brc_entity_index(): string
{
    $cul = get_cul_not_err();
    $col = get_col_not_err();
    return <<<EOF
    SELECT DISTINCT culture_collection.code_acr, 
        MIN(culture.strain_id), 
        COUNT(DISTINCT(culture.strain_id))
    FROM culture_collection
        INNER JOIN culture_collection_number
            ON culture_collection_number.brc_id = culture_collection.id
        INNER JOIN culture
            ON culture.ccno_id = culture_collection_number.id
    WHERE {$cul} AND {$col}
    GROUP BY culture_collection.code_acr
    EOF;
}

function get_des_entity_index(): string
{
    $cul = get_cul_not_err();
    $col = get_col_not_err();
    return <<<EOF
    SELECT DISTINCT designation.designation,
        MIN(culture.strain_id), 
        COUNT(DISTINCT(culture.strain_id))  
    FROM designation 
    LEFT JOIN culture_relation
        ON designation.id = culture_relation.des_id 
    LEFT JOIN culture_collection_number
        ON culture_collection_number.dep_des_id  = designation.id
    LEFT JOIN culture_collection
        ON culture_collection_number.brc_id = culture_collection.id
    INNER JOIN culture
        ON culture.ccno_id = culture_collection_number.id 
            OR culture.id = culture_relation.cul_id 
            OR designation.id = culture.designation_id 
    WHERE {$cul} AND {$col}
    GROUP BY designation.designation;
    EOF;
}

function get_ccno_entity_index(): string
{
    $cul = get_cul_not_err();
    $col = get_col_not_err();
    return <<<EOF
    SELECT DISTINCT
        culture_collection_number.ccno_acr,
        culture_collection_number.ccno_pre_id,
        culture_collection_number.ccno_core_id,
        culture_collection_number.ccno_suf_id,
        culture.strain_id, 1  
    FROM culture
    INNER JOIN culture_collection_number
        ON culture.ccno_id = culture_collection_number.id
    INNER JOIN culture_collection
        ON culture_collection_number.brc_id = culture_collection.id
    WHERE {$cul} AND {$col};
    EOF;
}

function get_taxon_name_entity_index(): string
{
    $cul = get_cul_not_err();
    $col = get_col_not_err();
    return <<<EOF
    SELECT DISTINCT taxon_name.name_canonical,
        MIN(culture.strain_id), 
        COUNT(DISTINCT(culture.strain_id))  
    FROM strain
    LEFT JOIN culture
        ON culture.strain_id = strain.id
    INNER JOIN taxon_name
        ON taxon_name.id = strain.tax_id
    LEFT JOIN culture_collection_number
        ON culture_collection_number.id  = culture.ccno_id
    LEFT JOIN culture_collection
        ON culture_collection_number.brc_id = culture_collection.id
    WHERE {$cul} AND {$col}
    GROUP BY taxon_name.name_canonical;		
    EOF;
}

function get_seq_acc_entity_index(): string
{
    $cul = get_cul_not_err();
    $col = get_col_not_err();
    return <<<EOF
    SELECT DISTINCT sequence.accession_number, 
        MIN(culture.strain_id), 
        COUNT(DISTINCT(culture.strain_id))  
    FROM sequence   
    INNER JOIN sequenced_strain
        ON sequenced_strain.seq_id = sequence.id 
    INNER JOIN designation
        ON sequenced_strain.des_id = designation.id
    INNER JOIN culture
        ON designation.id = culture.designation_id 
    LEFT JOIN culture_collection_number
        ON culture_collection_number.id  = culture.ccno_id
    LEFT JOIN culture_collection
        ON culture_collection_number.brc_id = culture_collection.id
    WHERE {$cul} AND {$col}
    GROUP BY sequence.accession_number; 	
    EOF;
}
