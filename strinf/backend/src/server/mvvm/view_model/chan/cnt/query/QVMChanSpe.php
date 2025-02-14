<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\view_model\chan\cnt\query;

final class QVMChanSpe extends QVMChanCnt
{
    public function getCount(): int
    {
        return $this->getMChan()->getSpeciesCount();
    }
}
