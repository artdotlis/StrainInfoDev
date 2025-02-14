<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\view_model\chan\all\query;

final class QVMChanTCul extends QVMChanAll
{
    /** @return array<int> */
    public function getResult(): array
    {
        return $this->getMChan()->getAllTCulIds();
    }
}
