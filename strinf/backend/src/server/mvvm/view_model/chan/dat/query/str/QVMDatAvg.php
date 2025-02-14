<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\view_model\chan\dat\query\str;

use straininfo\server\mvvm\view_model\chan\dat\query\QVMChanDat;
use straininfo\server\shared\mvvm\view\api\VersionE;

use function straininfo\server\shared\mvvm\view_model\struct\parser\str\v1\parse_avg_arr as parse_avg_arr_v1;
use function straininfo\server\shared\mvvm\view_model\struct\parser\str\v2\parse_avg_arr as parse_avg_arr_v2;

/**
 * @extends QVMChanDat<\straininfo\server\shared\mvvm\view_model\data\ParStr>
 */
final class QVMDatAvg extends QVMChanDat
{
    /**
     * @param array<int> $arg
     *
     * @return array<int, \straininfo\server\shared\mvvm\view_model\data\ParStr>
     */
    public function getResult(array $arg, VersionE $version): array
    {
        $narg = $this->getMChan()->getAvg($arg);
        return match ($version) {
            VersionE::V1 => parse_avg_arr_v1($narg),
            default => parse_avg_arr_v2($narg)
        };
    }
}
