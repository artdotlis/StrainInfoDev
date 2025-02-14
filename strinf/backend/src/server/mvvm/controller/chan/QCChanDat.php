<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\controller\chan;

use straininfo\server\interfaces\mvvm\controller\chan\QCIntDat;
use straininfo\server\mvvm\controller\const\ConCtrlDat;
use function straininfo\server\mvvm\controller\const\get_ent_by_id;

use straininfo\server\shared\mvvm\view\api\VersionE;

/**
 * @template T of \straininfo\server\shared\mvvm\view_model\data\ParCul|\straininfo\server\shared\mvvm\view_model\data\ParStr
 */
final class QCChanDat implements QCIntDat
{
    /**
     * @param ConCtrlDat<T, \straininfo\server\interfaces\mvvm\view_model\chan\query\QVMIntDat<T>> $con_q
     * @param ConCtrlDat<null, \straininfo\server\interfaces\mvvm\view_model\chan\cache\CaVMIntDat> $con_b
     */
    public function __construct(
        private readonly ConCtrlDat $con_q,
        private readonly ConCtrlDat $con_b
    ) {
    }

    /** @return array{string, bool} */
    public function getAvg(string $id, VersionE $version): array
    {
        return get_ent_by_id($version, $id, $this->con_q->getAvg(), $this->con_b->getAvg(), );
    }

    /** @return array{string, bool} */
    public function getMax(string $id, VersionE $version): array
    {
        return get_ent_by_id($version, $id, $this->con_q->getMax(), $this->con_b->getMax());
    }

    /** @return array{string, bool} */
    public function getMin(string $id, VersionE $version): array
    {
        return get_ent_by_id($version, $id, $this->con_q->getMin(), $this->con_b->getMin());
    }
}
