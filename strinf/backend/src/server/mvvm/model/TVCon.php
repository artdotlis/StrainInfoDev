<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\mvvm\model;

use straininfo\server\interfaces\mvvm\model\chan\con\ToViewIntMCaGet;
use straininfo\server\interfaces\mvvm\model\chan\con\ToViewIntMCaSet;
use straininfo\server\interfaces\mvvm\model\chan\con\ToViewIntMInd;
use straininfo\server\interfaces\mvvm\model\chan\con\ToViewIntMQ;
use straininfo\server\interfaces\mvvm\model\TVConInt;
use straininfo\server\mvvm\model\chan\con\ToViewMCaGet;
use straininfo\server\mvvm\model\chan\con\ToViewMCaSet;
use straininfo\server\mvvm\model\chan\con\ToViewMInSea;
use straininfo\server\mvvm\model\chan\con\ToViewMQ;

/**
 * @implements TVConInt<array<string, object>, array<string, object>>
 */
final class TVCon implements TVConInt
{
    /** @var ToViewIntMQ<array<string, object>, array<string, object>>*/
    private ToViewIntMQ $q_chan;
    private ToViewIntMCaGet $b_chan;
    private ToViewIntMCaSet $b_chan_set;
    private ToViewIntMInd $index;

    public function __construct(DBCData $dbc_data, DBCCache $dbc_ca, DBCIndex $dbc_ind)
    {
        $this->q_chan = new ToViewMQ($dbc_data->getDBC());
        $this->b_chan = new ToViewMCaGet($dbc_ca->getDBC());
        $this->b_chan_set = new ToViewMCaSet($dbc_ca->getDBC());
        $this->index = new ToViewMInSea($dbc_ind->getDBC());
    }

    /**
     * @return ToViewIntMQ<array<string, object>, array<string, object>>
     */
    public function getToViewQChan(): ToViewIntMQ
    {
        return $this->q_chan;
    }

    public function getToViewCaGetChan(): ToViewIntMCaGet
    {
        return $this->b_chan;
    }

    public function getToViewCaSetChan(): ToViewIntMCaSet
    {
        return $this->b_chan_set;
    }

    public function getToViewIndChan(): ToViewIntMInd
    {
        return $this->index;
    }

    public function setMaintenance(bool $mnt): void
    {
        $this->q_chan->setMaintenance($mnt);
        $this->b_chan->setMaintenance($mnt);
        $this->b_chan_set->setMaintenance($mnt);
        $this->index->setMaintenance($mnt);
    }
}
