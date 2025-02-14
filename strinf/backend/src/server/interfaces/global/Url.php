<?php

declare(strict_types=1);

namespace straininfo\server\interfaces\global;

interface Url
{
    public function getDomain(): string;

    /** @return "https" | "http" */
    public function getProtocol(): mixed;

    public function getPort(): int;
}
