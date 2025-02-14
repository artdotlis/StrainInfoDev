<?php

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\controller;

interface CtrlIntVM
{
    public function getViewCharSet(): string;

    public function setMaintenanceV(?\DateTime $finish_time): void;
}
