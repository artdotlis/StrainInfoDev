<?php

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\model;

use straininfo\server\interfaces\mvvm\model\chan\con\ToViewIntMCaGet;
use straininfo\server\interfaces\mvvm\model\chan\con\ToViewIntMCaSet;
use straininfo\server\interfaces\mvvm\model\chan\con\ToViewIntMInd;
use straininfo\server\interfaces\mvvm\model\chan\con\ToViewIntMQ;

/**
 * @template TC
 * @template TS
 */
interface TVConInt
{
    /** @return ToViewIntMQ<TC, TS> */
    public function getToViewQChan(): ToViewIntMQ;

    public function getToViewCaGetChan(): ToViewIntMCaGet;

    public function getToViewCaSetChan(): ToViewIntMCaSet;

    public function getToViewIndChan(): ToViewIntMInd;

    public function setMaintenance(bool $maintenance): void;
}
