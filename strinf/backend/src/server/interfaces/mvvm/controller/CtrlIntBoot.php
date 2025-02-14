<?php

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\controller;

use straininfo\server\interfaces\global\Runnable;

interface CtrlIntBoot extends Runnable
{
    public function run(): void;

    public function setMaintenance(?\DateTime $finish_time, bool $mnt): void;
}
