<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\view;

use Psr\Log\LoggerInterface;
use straininfo\server\exceptions\init_phase\KnownRunExc;
use straininfo\server\interfaces\mvvm\controller\CtrlIntV;
use straininfo\server\interfaces\mvvm\view\ToViewIntV;
use straininfo\server\interfaces\mvvm\view\VIntCtrl;
use straininfo\server\shared\exc\KEAct;
use straininfo\server\shared\logger\LogLevE;
use straininfo\server\shared\mvvm\view\StatArgs;
use straininfo\server\shared\mvvm\view\WebArgsBE;
use straininfo\server\shared\mvvm\view\WebArgsFE;
use straininfo\server\shared\state\RunState;

final class MainView implements VIntCtrl
{
    private RunState $running;
    private bool $success;

    // immutable
    // first level
    private ?CtrlIntV $controller;
    private readonly VFrameWorkCon $app_fac;

    // mutable
    // second level
    private ToViewIntV $chan;

    public function __construct(
        LoggerInterface $logger,
        WebArgsBE $wbe_args,
        WebArgsFE $wfe_args,
        StatArgs $stat_args,
        string $version
    ) {
        $this->controller = null;
        $this->running = RunState::NOT_RUNNING;
        $this->success = false;
        $this->app_fac = new VFrameWorkCon(
            $logger,
            $wbe_args,
            $wfe_args,
            $stat_args,
            $version
        );
    }

    // controller
    public function setMaintenanceV(
        ?\DateTime $finish_time,
        \DateTimeZone $zone,
        bool $mnt
    ): void {
        $this->app_fac->setMaintenance($finish_time, $zone, $mnt);
    }

    public function getCharSet(): string
    {
        return $this->app_fac->getWebArgs()->getCharSet();
    }

    // create connection
    public function setController(CtrlIntV $controller): void
    {
        $this->controller ??= $controller;
    }

    public function getController(): CtrlIntV
    {
        if (is_null($this->controller)) {
            throw new KnownRunExc(
                'MainView - was not started properly!',
                LogLevE::CRITICAL,
                KEAct::TERM
            );
        }
        return $this->controller;
    }
    // run after start
    public function run(): void
    {
        $this->app_fac->run();
    }

    public function start(): void
    {
        match ($this->running) {
            RunState::NOT_RUNNING => $this->startWr(),
            default => throw new KnownRunExc(
                'MainView - could not be started!',
                LogLevE::WARNING,
                KEAct::WARN
            )
        };
    }

    public function stop(): void
    {
        match ($this->running) {
            RunState::RUNNING => $this->stopWr(),
            default => throw new KnownRunExc(
                'MainView - could not be stopped!',
                LogLevE::WARNING,
                KEAct::WARN
            )
        };
    }

    public function setSuccess(): void
    {
        $this->success = true;
    }

    private function startWr(): void
    {
        $this->chan = new ToViewChanV($this->getController()->getToViewChan());
        $this->app_fac->initSlim($this->chan);
        $this->running = RunState::RUNNING;
    }

    private function stopWr(): void
    {
        $this->running = RunState::STOPPED;
        if (!$this->success) {
            throw new KnownRunExc(
                'View was never successfully started!',
                LogLevE::WARNING,
                KEAct::WARN
            );
        }
    }
}
