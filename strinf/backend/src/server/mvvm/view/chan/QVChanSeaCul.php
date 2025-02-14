<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\view\chan;

use straininfo\server\interfaces\mvvm\controller\chan\QCIntSeaCulId;
use straininfo\server\interfaces\mvvm\view\chan\QVIntSeaIdCul;

final class QVChanSeaCul extends QVChanSea implements QVIntSeaIdCul
{
    private readonly QCIntSeaCulId $q_chan;

    public function __construct(QCIntSeaCulId $q_chan)
    {
        $this->q_chan = $q_chan;
        parent::__construct($q_chan);
    }

    /** @return array{string, bool} */
    public function getStrId(string $str_id): array
    {
        return $this->q_chan->getStrId($str_id);
    }
}
