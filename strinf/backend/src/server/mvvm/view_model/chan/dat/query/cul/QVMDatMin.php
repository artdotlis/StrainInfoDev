<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\view_model\chan\dat\query\cul;

use straininfo\server\mvvm\view_model\chan\dat\query\QVMChanDat;
use straininfo\server\shared\mvvm\view\api\VersionE;

use function straininfo\server\shared\mvvm\view_model\struct\parser\cul\v1\parse_min_arr as parse_min_arr_v1;
use function straininfo\server\shared\mvvm\view_model\struct\parser\cul\v2\parse_min_arr as parse_min_arr_v2;

/**
 * @extends QVMChanDat<\straininfo\server\shared\mvvm\view_model\data\ParCul>
 */
final class QVMDatMin extends QVMChanDat
{
    /**
     * @param array<int> $arg
     *
     * @return array<int, \straininfo\server\shared\mvvm\view_model\data\ParCul>
     */
    public function getResult(array $arg, VersionE $version): array
    {
        $narg = $this->getMChan()->getMin($arg);
        return match ($version) {
            VersionE::V1 => parse_min_arr_v1($narg),
            default => parse_min_arr_v2($narg)
        };
    }
}
