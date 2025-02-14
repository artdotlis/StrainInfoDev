<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\view_model\chan\cnt\query;

final class QVMChanArc extends QVMChanCnt
{
    public function getCount(): int
    {
        return $this->getMChan()->getArchiveCount();
    }
}
