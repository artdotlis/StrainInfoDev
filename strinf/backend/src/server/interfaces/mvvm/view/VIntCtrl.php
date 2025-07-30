<?php

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\view;

use Slim\App;
use straininfo\server\interfaces\global\Runnable;
use straininfo\server\interfaces\mvvm\controller\CtrlIntV;

interface VIntCtrl extends Runnable
{
    public function setController(CtrlIntV $controller): void;

    public function run(): void;

    public function getCharSet(): string;

    public function setMaintenanceV(
        ?\DateTime $finish_time,
        \DateTimeZone $zone,
        bool $mnt
    ): void;
    /** @return App<\Psr\Container\ContainerInterface|null> */
    public function getApp(): App;
}
