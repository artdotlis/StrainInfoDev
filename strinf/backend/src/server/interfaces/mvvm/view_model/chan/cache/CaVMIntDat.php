<?php

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\view_model\chan\cache;

use straininfo\server\shared\mvvm\view\api\VersionE;
use straininfo\server\shared\mvvm\view_model\data\QDConIdEnt;

interface CaVMIntDat
{
    /**
     * @param array<int> $ids
     *
     * @return QDConIdEnt<int>
     */
    public function getResult(array $ids, VersionE $version): QDConIdEnt;

    /** @param QDConIdEnt<int> $ent_con */
    public function setResult(QDConIdEnt $ent_con, VersionE $version, bool $perm): void;

    public function permanent(VersionE $version): bool;
}
