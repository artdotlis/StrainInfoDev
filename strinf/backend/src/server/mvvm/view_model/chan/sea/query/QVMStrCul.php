<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\view_model\chan\sea\query;

use function Safe\preg_replace;
use function straininfo\server\shared\arr\filter_arr;
use function straininfo\server\shared\arr\parse_str_2_arr;

/**
 * @extends QVMChanSea<int, \straininfo\server\interfaces\mvvm\model\chan\query\QMIntSeaIdStr>
 */
final class QVMStrCul extends QVMChanSea
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
        foreach ($arg as $cul) {
            $res_id[$cul] = $this->getMChan()->getCulId([$cul]);
            array_push($res, ...$res_id[$cul]);
        }
        return filter_arr(
            static fn (array $val): bool => (bool) $val,
            $res_id
        );
    }
}
