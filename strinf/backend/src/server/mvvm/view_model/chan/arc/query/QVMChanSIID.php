<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\view_model\chan\arc\query;

use function Safe\preg_replace;
use function straininfo\server\shared\arr\parse_str_2_arr;

final class QVMChanSIID extends QVMChanArc
{
    /** @return array<string> */
    public function parseArg(string $arg): array
    {
        return parse_str_2_arr(
            preg_replace(
                '/SI-ID\s*(\d+\.\d+)/',
                '10.60712/SI-ID$1',
                preg_replace('/[^SID\s\d.,\-]/', '', $arg)
            ),
            static fn (string $val): string => $val,
            1
        );
    }

    /**
     * @param array<string> $arg
     *
     * @return array<string, string>
     */
    public function getResult(array $arg): array
    {
        return $this->getMChan()->getArcBySiId($arg);
    }
}
