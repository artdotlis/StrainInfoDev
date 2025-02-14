<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\controller\chan;

use straininfo\server\interfaces\mvvm\controller\chan\QCIntArc;
use straininfo\server\mvvm\controller\const\ConCtrlArc;

use function straininfo\server\mvvm\controller\const\get_arc_by_si_id;

final class QCChanArc implements QCIntArc
{
    /**
     * @param ConCtrlArc<\straininfo\server\interfaces\mvvm\view_model\chan\query\QVMIntArc> $con_q
     * @param ConCtrlArc<\straininfo\server\interfaces\mvvm\view_model\chan\cache\CaVMIntArc> $con_b
     */
    public function __construct(
        private readonly ConCtrlArc $con_q,
        private readonly ConCtrlArc $con_b
    ) {
    }

    /** @return array{string, bool} */
    public function getArcSiId(string $id): array
    {
        return get_arc_by_si_id($id, $this->con_q->getArc(), $this->con_b->getArc());
    }
}
