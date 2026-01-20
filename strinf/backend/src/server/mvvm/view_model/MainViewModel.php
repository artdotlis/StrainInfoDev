<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\mvvm\view_model;

use Safe\DateTime;
use straininfo\server\exceptions\init_phase\KnownRunExc;
use straininfo\server\interfaces\mvvm\controller\CtrlIntVM;
use straininfo\server\interfaces\mvvm\model\MIntVM;
use straininfo\server\interfaces\mvvm\view_model\VMIntCtrl;
use straininfo\server\interfaces\mvvm\view_model\VMIntM;
use straininfo\server\shared\exc\KEAct;
use straininfo\server\shared\logger\LogLevE;
use straininfo\server\shared\state\RunState;

/**
 * @phpstan-type ParCul \straininfo\server\shared\mvvm\view_model\data\ParCul
 * @phpstan-type ParStr \straininfo\server\shared\mvvm\view_model\data\ParStr
 *
 * @implements VMIntCtrl<ParCul, ParStr, int>
 */
final class MainViewModel implements VMIntCtrl, VMIntM
{
    private RunState $running;
    private bool $success;

    // immutable
    // first level
    private ?CtrlIntVM $controller;

    /** @var MIntVM<array<string, object>, array<string, object>> */
    private readonly MIntVM $main_model;

    // mutable
    // second level
    private TVConSer $q_chan_ser;
    private TVConVer $q_chan_ver;

    /**
     * @param MIntVM<array<string, object>, array<string, object>> $model
     */
    public function __construct(MIntVM $model)
    {
        $this->controller = null;
        $this->running = RunState::NOT_RUNNING;
        $this->success = false;
        $this->main_model = $model;
        $this->main_model->setViewModel($this);
    }

    // channels
    public function getToViewSerCon(): TVConSer
    {
        return $this->q_chan_ser;
    }

    public function getToViewVerCon(): TVConVer
    {
        return $this->q_chan_ver;
    }

    // controller
    public function getTimeZone(): \DateTimeZone
    {
        return $this->main_model->getTimeZone();
    }

    public function setMaintenanceM(bool $mnt): void
    {
        $this->main_model->setMaintenanceM($mnt);
    }

    // model
    public function setMaintenanceV(): void
    {
        $f_time = null;
        if (0 < $this->main_model->getUnixMTime()) {
            $f_time = new DateTime("@{$this->main_model->getUnixMTime()}");
        }
        $this->getController()->setMaintenanceV($f_time);
    }

    // create connection
    public function setController(CtrlIntVM $controller): void
    {
        $this->controller ??= $controller;
    }

    public function getController(): CtrlIntVM
    {
        if (is_null($this->controller)) {
            throw new KnownRunExc(
                'MainViewModel - was not started properly!',
                LogLevE::CRITICAL,
                KEAct::TERM
            );
        }
        return $this->controller;
    }

    // runnable
    public function start(): void
    {
        match ($this->running) {
            RunState::NOT_RUNNING => $this->main_model->start(),
            default => throw new KnownRunExc(
                'MainViewModel - could not be started!',
                LogLevE::WARNING,
                KEAct::WARN
            )
        };
        $this->q_chan_ver = new TVConVer(
            $this->main_model->getCharSet(),
            $this->getController()->getViewCharSet(),
            $this->main_model->getToViewCon()->getToViewCaGetChan(),
            $this->main_model->getToViewCon()->getToViewCaSetChan(),
            $this->main_model->getToViewCon()->getToViewQChan()
        );
        $this->q_chan_ser = new TVConSer(
            $this->main_model->getCharSet(),
            $this->getController()->getViewCharSet(),
            $this->main_model->getKeyLen(),
            [
                'get' => $this->main_model->getToViewCon()->getToViewCaGetChan(),
                'set' => $this->main_model->getToViewCon()->getToViewCaSetChan(),
            ],
            [
                'db' => $this->main_model->getToViewCon()->getToViewQChan(),
                'in' => $this->main_model->getToViewCon()->getToViewIndChan(),
            ]
        );
        $this->running = RunState::RUNNING;
    }

    public function stop(): void
    {
        match ($this->running) {
            RunState::RUNNING => $this->main_model->stop(),
            default => throw new KnownRunExc(
                'MainViewModel - could not be stopped!',
                LogLevE::WARNING,
                KEAct::WARN
            )
        };
        $this->running = RunState::STOPPED;
        if (!$this->success) {
            throw new KnownRunExc(
                'View-Model was never successfully started!',
                LogLevE::WARNING,
                KEAct::WARN
            );
        }
    }

    public function setSuccess(): void
    {
        $this->success = true;
        $this->main_model->setSuccess();
    }
}
