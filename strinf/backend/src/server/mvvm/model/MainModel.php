<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\mvvm\model;

use straininfo\server\shared\state\RunState;
use straininfo\server\shared\mvvm\model\ModelArgs;
use straininfo\server\shared\mvvm\model\DBArgs;
use straininfo\server\shared\mvvm\model\CacheArgs;
use straininfo\server\shared\logger\LogLevE;
use straininfo\server\shared\exc\KEAct;
use straininfo\server\shared\cron\IndexArgs;
use straininfo\server\interfaces\mvvm\view_model\VMIntM;
use straininfo\server\interfaces\mvvm\model\MIntVM;
use straininfo\server\exceptions\init_phase\KnownRunExc;
use straininfo\server\exceptions\init_phase\KnownMaintainExc;

/**
 * @implements MIntVM<array<string, object>, array<string, object>>
 */
final class MainModel implements MIntVM
{
    private RunState $running;
    private bool $success;

    // immutable
    // first level
    private ?VMIntM $view_model;
    private readonly DBCData $dbc_data;
    private readonly DBCCache $dbc_cache;
    private readonly DBCIndex $dbc_index;
    private readonly ModelArgs $m_args;

    // mutable
    // second level
    private TVCon $q_chan;

    public function __construct(
        DBArgs $d_args,
        CacheArgs $ca_args,
        IndexArgs $in_args,
        ModelArgs $m_args
    ) {
        $this->view_model = null;
        $this->running = RunState::NOT_RUNNING;
        $this->success = false;
        $this->m_args = $m_args;
        $this->dbc_data = DBCData::getDBCIns($d_args);
        $this->dbc_cache = DBCCache::getDBCIns($ca_args);
        $this->dbc_index = DBCIndex::getDBCIns($in_args);
    }

    // view model (ConIntVM)
    public function getCharSet(): string
    {
        return $this->dbc_data->getDBC()->getQDBConf()->getCharSet();
    }

    public function getKeyLen(): int
    {
        return $this->dbc_index->getDBC()->getIDBConf()->getKeyLen();
    }

    public function getTimeZone(): \DateTimeZone
    {
        return $this->m_args->getTimeZone();
    }

    public function getUnixMTime(): int
    {
        return $this->m_args->getMaintenance();
    }

    // channels
    public function getToViewCon(): TVCon
    {
        return $this->q_chan;
    }

    // view_model
    public function setMaintenanceM(bool $mnt): void
    {
        $this->q_chan->setMaintenance($mnt);
        match ($this->running) {
            RunState::MAINTENANCE => !$mnt ?: $this->startWr(),
            RunState::RUNNING => $this->maintenanceWrR($mnt),
            default => throw new KnownMaintainExc(
                'MainModel - Maintenance could not be set!',
                LogLevE::ERROR,
                KEAct::WARN
            )
        };
    }

    public function maintenanceWrR(bool $mnt): void
    {
        if ($mnt) {
            $this->stopWr();
            $this->running = RunState::MAINTENANCE;
        }
    }
    // create connection
    public function setViewModel(VMIntM $view_model): void
    {
        $this->view_model ??= $view_model;
    }

    public function getViewModel(): VMIntM
    {
        if (is_null($this->view_model)) {
            throw new KnownRunExc(
                'MainModel - was not started properly!',
                LogLevE::CRITICAL,
                KEAct::TERM
            );
        }
        return $this->view_model;
    }
    // runnable
    public function start(): void
    {
        $mnt = $this->m_args->getMaintenance() > 0;
        match ($this->running) {
            RunState::NOT_RUNNING => $mnt ? $this->startMt() : $this->startWr(),
            default => throw new KnownRunExc(
                'MainModel - could not be started!',
                LogLevE::WARNING,
                KEAct::WARN
            )
        };
        $this->q_chan = new TVCon($this->dbc_data, $this->dbc_cache, $this->dbc_index);
        $this->q_chan->setMaintenance($mnt);
    }

    public function stop(): void
    {
        match ($this->running) {
            RunState::MAINTENANCE => true,
            RunState::RUNNING => $this->stopWr(),
            default => throw new KnownRunExc(
                'MainModel - could not be stopped!',
                LogLevE::WARNING,
                KEAct::WARN
            )
        };
    }

    public function setSuccess(): void
    {
        $this->success = true;
        $this->dbc_data->setSuccess();
        $this->dbc_cache->setSuccess();
        $this->dbc_index->setSuccess();
    }

    private function startMt(): void
    {
        $this->getViewModel()->setMaintenanceV();
        $this->running = RunState::MAINTENANCE;
    }

    private function startWr(): void
    {
        $this->dbc_data->start();
        $this->dbc_cache->start();
        $this->dbc_index->start();
        $this->running = RunState::RUNNING;
    }

    private function stopWr(): void
    {
        $this->dbc_data->stop();
        $this->dbc_cache->stop();
        $this->dbc_index->stop();
        $this->running = RunState::STOPPED;
        if (!$this->success) {
            throw new KnownRunExc(
                'Model was never successfully started!',
                LogLevE::WARNING,
                KEAct::WARN
            );
        }
    }
}
