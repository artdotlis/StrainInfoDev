<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\view_model\chan\sea\query;

use function Safe\preg_replace;
use function straininfo\server\shared\arr\parse_str_2_arr;

/**
 * @extends QVMChanSea<int, \straininfo\server\interfaces\mvvm\model\chan\query\QMIntSeaIdCul>
 */
final class QVMCulStr extends QVMChanSea
{
    /** @return array<int>*/
    public function parseArg(string $arg): array
    {
        return parse_str_2_arr(
            preg_replace('/[^0-9,]+/', '', $arg),
            static fn (string $val): int => (int) $val,
            1
        );
    }

    /**
     * @param array<int> $arg
     *
     * @return array<int, array<int>>
     */
    public function getResult(array $arg): array
    {
        $res = [];
        $res_id = [];
        foreach ($arg as $str) {
            $res_id[$str] = $this->getMChan()->getStrId([$str]);
            array_push($res, ...$res_id[$str]);
        }
        return array_filter(
            $res_id,
            static fn (array $val): bool => (bool) $val
        );
    }
}
