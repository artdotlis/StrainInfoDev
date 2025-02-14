<?php

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\view_model\chan\cache;

use straininfo\server\shared\mvvm\view_model\data\QDConIdEnt;

interface CaVMIntArc
{
    /**
     * @param array<string> $ids
     *
     * @return QDConIdEnt<string>
     */
    public function getResult(array $ids): QDConIdEnt;

    /** @param QDConIdEnt<string> $arc_con */
    public function setResult(QDConIdEnt $arc_con): void;
}
