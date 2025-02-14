<?php

declare(strict_types=1);

namespace straininfo\server\interfaces\global;

interface Runnable
{
    public function start(): void;

    public function stop(): void;

    public function setSuccess(): void;
}
