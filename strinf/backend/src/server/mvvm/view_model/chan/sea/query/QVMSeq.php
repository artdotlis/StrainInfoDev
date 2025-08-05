<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\view_model\chan\sea\query;

use function Safe\preg_replace;
use function straininfo\server\shared\arr\parse_ban_str;
use function straininfo\server\shared\arr\parse_str_2_arr;

/**
 * @extends QVMChanSea<string, \straininfo\server\interfaces\mvvm\model\chan\query\QMIntSeaId>
 *
 * Only nucleotide sequence, no proteins
 */
final class QVMSeq extends QVMChanSea
{
    /** @return array<string>*/
    public function parseArg(string $arg): array
    {
        $ban_chars = $this->getMChan()->getBanChars();
        # TODO: very complex RegExp -> can lead to runaway regexp
        return parse_str_2_arr(
            preg_replace($this->createReg(), '$2', $arg),
            static function (string $val) use ($ban_chars): string {
                return parse_ban_str($val, $ban_chars);
            },
            6
        );
    }

    /**
     * @param array<string> $arg
     *
     * @return array<string, array<int>>
     */
    public function getResult(array $arg): array
    {
        $res = [];
        $res_id = [];
        foreach ($arg as $seq) {
            $res_id[$seq] = $this->getMChan()->getSeqAcc([$seq]);
            array_push($res, ...$res_id[$seq]);
        }
        return array_filter(
            $res_id,
            static fn (array $val): bool => (bool) $val
        );
    }

    private static function createReg(): string
    {
        return '/((('
            // Nucleotide
            . '[A-Z]\d{5}|[A-Z]{2}\d{6}|[A-Z]{2}\d{8}'
            // WGS
            . '|[A-Z]{4}\d{8,}|[A-Z]{6}\d{9,}'
            // MGA
            . '|[A-Z]{5}\d{7}'
            // RefSeq - dna/rna only - TODO how many numbers ?
            . '|(?:AC_|NC_|NG_|NT_|NW_|NZ_|NM_|NR_|XM_|XR_)\d+'
            // GENBANK + REFSEQ assemblies
            . '|(GCA_|GCF_)\d+|,)+)|.)+/';
    }
}
