<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\view_model\chan\sea\query;

use function straininfo\server\shared\arr\filter_arr;
use function straininfo\server\shared\arr\parse_ban_str;
use function straininfo\server\shared\arr\parse_str_2_arr;

/**
 * @extends QVMChanSea<string, \straininfo\server\interfaces\mvvm\model\chan\query\QMIntSeaId>
 */
final class QVMStrDes extends QVMChanSea
{
    /** @return array<string>*/
    public function parseArg(string $arg): array
    {
        $ban_chars = $this->getMChan()->getBanChars();
        return parse_str_2_arr(
            $arg,
            static function (string $val) use ($ban_chars): string {
                return (string) parse_ban_str($val, $ban_chars);
            },
            2
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
        foreach ($arg as $str_des) {
            $res_id[$str_des] = $this->getMChan()->getStrDes([$str_des]);
            array_push($res, ...$res_id[$str_des]);
        }
        return filter_arr(
            static fn (array $val): bool => (bool) $val,
            $res_id
        );
    }
}
