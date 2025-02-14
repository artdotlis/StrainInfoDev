<?php

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\model\chan\cache;

use straininfo\server\interfaces\mvvm\model\chan\MainChannel;

interface CaMIntCntSet extends MainChannel
{
    public function setStrainCount(int $cnt): void;

    public function setArchiveCount(int $cnt): void;

    public function setTypeStrainCount(int $cnt): void;

    public function setTypeCultureCount(int $cnt): void;

    public function setSpeciesCount(int $cnt): void;

    public function setCultureCount(int $cnt): void;

    public function setDesignationCount(int $cnt): void;
}
