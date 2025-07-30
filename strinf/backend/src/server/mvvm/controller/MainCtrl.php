<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\controller;

use Slim\App;
use straininfo\server\exceptions\init_phase\KnownRunExc;
use straininfo\server\interfaces\mvvm\controller\CtrlIntBoot;
use straininfo\server\interfaces\mvvm\controller\CtrlIntV;
use straininfo\server\interfaces\mvvm\controller\CtrlIntVM;
use straininfo\server\interfaces\mvvm\controller\ToViewIntC;
use straininfo\server\interfaces\mvvm\view\VIntCtrl;
use straininfo\server\interfaces\mvvm\view_model\VMIntCtrl;
use straininfo\server\shared\exc\KEAct;
use straininfo\server\shared\logger\LogLevE;
use straininfo\server\shared\state\RunState;

/**
 * @phpstan-type ParCul \straininfo\server\shared\mvvm\view_model\data\ParCul
 * @phpstan-type ParStr \straininfo\server\shared\mvvm\view_model\data\ParStr
 */
final class MainCtrl implements CtrlIntVM, CtrlIntV, CtrlIntBoot
{
    private RunState $running;
    private bool $success;

    // immutable
    // first level
    private readonly VIntCtrl $main_view;

    /** @var VMIntCtrl<ParCul, ParStr, int> */
    private readonly VMIntCtrl $main_view_model;

    // mutable
    // second level
    private ToViewIntC $chan;

    /** @param VMIntCtrl<ParCul, ParStr, int> $view_model */
    public function __construct(VIntCtrl $view, VMIntCtrl $view_model)
    {
        $this->running = RunState::NOT_RUNNING;
        $this->success = false;
        $this->main_view_model = $view_model;
        $this->main_view_model->setController($this);
        $this->main_view = $view;
        $this->main_view->setController($this);
    }
    // view
    public function setMaintenanceV(?\DateTime $finish_time): void
    {
        $this->main_view->setMaintenanceV(
            $finish_time,
            $this->main_view_model->getTimeZone(),
            true
        );
    }
    // view model (ConIntVM)
    public function getViewCharSet(): string
    {
        return $this->main_view->getCharSet();
    }
    //channels
    public function getToViewChan(): ToViewIntC
    {
        return $this->chan;
    }

    // bootstrap
    public function run(): void
    {
        $this->main_view->run();
    }

    public function setMaintenance(?\DateTime $finish_time, bool $mnt): void
    {
        $this->main_view->setMaintenanceV(
            $finish_time,
            $this->main_view_model->getTimeZone(),
            $mnt
        );
        $this->main_view_model->setMaintenanceM($mnt);
    }
    // runnable
    public function start(): void
    {
        match ($this->running) {
            RunState::NOT_RUNNING => $this->startWr(),
            default => throw new KnownRunExc(
                'MainCon - could not be started!',
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
                'MainCon - could not be stopped!',
                LogLevE::WARNING,
                KEAct::WARN
            )
        };
    }

    public function setSuccess(): void
    {
        $this->success = true;
        $this->main_view->setSuccess();
        $this->main_view_model->setSuccess();
    }
    /** @return App<\Psr\Container\ContainerInterface|null> */
    public function getApp(): App
    {
        return $this->main_view->getApp();
    }

    private function stopWr(): void
    {
        $this->main_view->stop();
        $this->main_view_model->stop();
        $this->running = RunState::STOPPED;
        if (!$this->success) {
            throw new KnownRunExc(
                'Controller was never successfully started!',
                LogLevE::WARNING,
                KEAct::WARN
            );
        }
    }

    private function startWr(): void
    {
        $this->main_view_model->start();
        $this->chan = new ToViewChanC($this->main_view_model);
        $this->main_view->start();
        $this->running = RunState::RUNNING;
    }
}
