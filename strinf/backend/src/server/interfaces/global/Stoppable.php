<?php

declare(strict_types=1);

namespace straininfo\server\interfaces\global;

interface Stoppable
{
    public function stop(): void;

    public function isStopped(): bool;
}
