<?php

declare(strict_types=1);

namespace straininfo\server\exceptions;

use straininfo\server\shared\exc\KEAct;
use straininfo\server\shared\logger\LogLevE;

abstract class KnownExc extends \Exception
{
    private readonly KEAct $act;
    private readonly LogLevE $level;

    public function __construct(string $msg, LogLevE $level, KEAct $act)
    {
        parent::__construct($msg, 1);
        $this->act = $act;
        $this->level = $level;
    }

    final public function getAct(): KEAct
    {
        return $this->act;
    }

    final public function getActStr(): string
    {
        return $this->act->value;
    }

    public function getLevel(): LogLevE
    {
        return $this->level;
    }

    public function getFullMessage(): string
    {
        $msg = parent::getMessage();
        return "[KNOWN-{$this->getActStr()}] => {$msg}";
    }
}
