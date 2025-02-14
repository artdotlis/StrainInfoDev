<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\model;

use straininfo\server\exceptions\init_phase\KnownRunExc;
use straininfo\server\interfaces\global\Runnable;
use straininfo\server\shared\exc\KEAct;
use straininfo\server\shared\logger\LogLevE;
use straininfo\server\shared\state\RunState;

abstract class DBCRun implements Runnable
{
    // status
    private RunState $running;
    private bool $success;

    public function __construct()
    {
        $this->running = RunState::NOT_RUNNING;
        $this->success = false;
    }

    public function __destruct()
    {
        $this->destroy();
    }

    public function start(): void
    {
        match ($this->running) {
            RunState::NOT_RUNNING,
            RunState::STOPPED => $this->connectWr(),
            default => throw new KnownRunExc(
                'DBC - could not be started!',
                LogLevE::WARNING,
                KEAct::WARN
            )
        };
    }

    public function stop(): void
    {
        match ($this->running) {
            RunState::RUNNING => $this->disconnectWr(),
            default => throw new KnownRunExc(
                'DBC - could not be stopped!',
                LogLevE::WARNING,
                KEAct::WARN
            )
        };
    }

    public function setSuccess(): void
    {
        $this->success = true;
    }

    abstract protected function destroy(): void;

    abstract protected function connect(): void;

    abstract protected function disconnect(): void;

    private function connectWr(): void
    {
        $this->connect();
        $this->running = RunState::RUNNING;
    }

    private function disconnectWr(): void
    {
        $this->disconnect();
        $this->running = RunState::STOPPED;
        if (!$this->success) {
            throw new KnownRunExc(
                'DBC was never successfully started!',
                LogLevE::WARNING,
                KEAct::WARN
            );
        }
    }
}
