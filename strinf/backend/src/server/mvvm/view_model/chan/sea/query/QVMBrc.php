<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\view_model\chan\sea\query;

use function Safe\preg_replace;
use function straininfo\server\shared\arr\filter_arr;
use function straininfo\server\shared\arr\parse_ban_str;
use function straininfo\server\shared\arr\parse_str_2_arr;

/**
 * @extends QVMChanSea<string, \straininfo\server\interfaces\mvvm\model\chan\query\QMIntSeaId>
 */
final class QVMBrc extends QVMChanSea
{
    /** @return array<string>*/
    public function parseArg(string $arg): array
    {
        $ban_chars = $this->getMChan()->getBanChars();
        $cast_arg = preg_replace('/[^A-Za-z,]+/', ':', $arg);
        return parse_str_2_arr(
            preg_replace('/:+/', ':', $cast_arg),
            static function (string $val) use ($ban_chars): string {
                return (string) parse_ban_str($val, $ban_chars);
            },
            3
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
        foreach ($arg as $brc) {
            $res_id[$brc] = $this->getMChan()->getBrc([$brc]);
            array_push($res, ...$res_id[$brc]);
        }
        return filter_arr(
            static fn (array $val): bool => (bool) $val,
            $res_id
        );
    }
}
