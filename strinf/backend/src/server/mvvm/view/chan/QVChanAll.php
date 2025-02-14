<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\view\chan;

use straininfo\server\interfaces\mvvm\controller\chan\QCIntAll;
use straininfo\server\interfaces\mvvm\view\chan\QVIntAll;

final class QVChanAll implements QVIntAll
{
    private readonly QCIntAll $q_chan;

    public function __construct(QCIntAll $q_chan)
    {
        $this->q_chan = $q_chan;
    }

    public function getAllCulId(): string
    {
        return $this->q_chan->getAllCulIds();
    }

    public function getAllTCulId(): string
    {
        return $this->q_chan->getAllTCulIds();
    }

    public function getAllStrId(): string
    {
        return $this->q_chan->getAllStrIds();
    }

    public function getAllTStrId(): string
    {
        return $this->q_chan->getAllTStrIds();
    }
}
