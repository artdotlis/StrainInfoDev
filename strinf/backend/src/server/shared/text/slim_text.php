<?php

declare(strict_types=1);

namespace straininfo\server\shared\text;

use function Safe\preg_match;
use function Safe\preg_replace;
use function Safe\preg_split;

/**
 * @return array{key: string, value: string}
 */
function create_slim_key_w(string $val, string $encode): array
{
    $clean = preg_replace('/[^A-Za-z0-9]+/', '', $val) ?: '';
    if (preg_match('/^[A-Za-z]+/', $clean) === 0) {
        return ['key' => '', 'value' => ''];
    }
    $clean = mb_strtoupper(
        preg_replace('/^([A-Za-z]+)([0-9])/', '\1-\2', $clean) ?: '',
        $encode
    );
    $res = preg_split('/-/', $clean);
    if (count($res) === 2) {
        return ['key' => $res[0], 'value' => $res[1]];
    }
    return ['key' => $clean, 'value' => ''];
}

function clean_arg_key_w(string $val, string $encode): string
{
    return mb_strtoupper(
        preg_replace('/[^A-Za-z0-9]+/', '', $val) ?: '',
        $encode
    );
}

const RANKS = [
    "dom\.?",
    "superreg\.?",
    "reg\.?",
    "subreg\.?",
    "infrareg\.?",
    "superphyl\.?",
    "phyl\.?",
    "subphyl\.?",
    "infraphyl\.?",
    "supercl\.?",
    "cl\.?",
    "subcl\.?",
    "infracl\.?",
    "parvcl\.?",
    "superleg\.?",
    "leg\.?",
    "subleg\.?",
    "infraleg\.?",
    'supercohort',
    'cohort',
    'subcohort',
    'infracohort',
    "magnord\.?",
    "superord\.?",
    "grandord\.?",
    "ord\.?",
    "subord\.?",
    "infraord\.?",
    "parvord\.?",
    "superfam\.?",
    "fam\.?",
    "subfam\.?",
    "infrafam\.?",
    "supertrib\.?",
    "trib\.?",
    "subtrib\.?",
    "infratrib\.?",
    "supragen\.?",
    "gen\.?",
    "subgen\.?",
    "infragen\.?",
    "sect\.?",
    "subsect\.?",
    "ser\.?",
    "subser\.?",
    'infrageneric',
    "agg\.?",
    "sp\.?",
    "infrasp\.?",
    'grex',
    "subsp\.?",
    'cultivar group',
    "convar\.?",
    "infrasubsp\.?",
    "prol\.?",
    'race',
    'natio',
    "ab\.?",
    'morph',
    "var\.?",
    "subvar\.?",
    "f\.?",
    "subf\.?",
    "pv\.?",
    'biovar',
    'chemovar',
    'morphovar',
    'phagovar',
    'serovar',
    'chemoform',
    "f\.?sp\.?",
    "cv\.?",
];

function rm_taxon_name_ranks(string $key): string
{
    return preg_replace(
        '/\s+(?:' . implode(
            '|',
            RANKS
        ) . ')\s+/i',
        ' ',
        $key
    ) ?: '';
}
