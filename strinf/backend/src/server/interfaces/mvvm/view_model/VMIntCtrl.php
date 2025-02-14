<?php

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\view_model;

use straininfo\server\interfaces\global\Runnable;
use straininfo\server\interfaces\mvvm\controller\CtrlIntVM;

/**
 * @template TC
 * @template TS
 * @template TD
 */
interface VMIntCtrl extends Runnable
{
    public function setController(CtrlIntVM $controller): void;

    /** @return TVConSerInt<TD> */
    public function getToViewSerCon(): TVConSerInt;

    /** @return TVConVerInt<TC, TS> */
    public function getToViewVerCon(): TVConVerInt;

    public function getTimeZone(): \DateTimeZone;

    public function setMaintenanceM(bool $mnt): void;
}
