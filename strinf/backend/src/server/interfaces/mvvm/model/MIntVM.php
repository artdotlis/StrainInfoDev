<?php

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\model;

use straininfo\server\interfaces\global\Runnable;
use straininfo\server\interfaces\mvvm\view_model\VMIntM;

/**
 * @template TC
 * @template TS
 */
interface MIntVM extends Runnable
{
    public function setViewModel(VMIntM $view_model): void;

    /** @return TVConInt<TC, TS> */
    public function getToViewCon(): TVConInt;

    public function getCharSet(): string;

    public function getKeyLen(): int;

    public function getTimeZone(): \DateTimeZone;

    public function getUnixMTime(): int;

    public function setMaintenanceM(bool $mnt): void;
}
