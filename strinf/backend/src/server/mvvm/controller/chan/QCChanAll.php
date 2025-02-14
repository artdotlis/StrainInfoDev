<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\controller\chan;

use straininfo\server\interfaces\mvvm\controller\chan\QCIntAll;
use straininfo\server\mvvm\controller\const\ConCtrlAll;

use function straininfo\server\mvvm\controller\const\get_all_id;

final class QCChanAll implements QCIntAll
{
    /**
     * @param ConCtrlAll<\straininfo\server\interfaces\mvvm\view_model\chan\query\QVMIntAll> $q_all
     * @param ConCtrlAll<\straininfo\server\interfaces\mvvm\view_model\chan\cache\CaVMIntAll> $b_all
     */
    public function __construct(
        private readonly ConCtrlAll $q_all,
        private readonly ConCtrlAll $b_all
    ) {
    }

    public function getAllCulIds(): string
    {
        return get_all_id($this->q_all->getCul(), $this->b_all->getCul());
    }

    public function getAllStrIds(): string
    {
        return get_all_id($this->q_all->getStr(), $this->b_all->getStr());
    }

    public function getAllTStrIds(): string
    {
        return get_all_id($this->q_all->getTStr(), $this->b_all->getTStr());
    }

    public function getAllTCulIds(): string
    {
        return get_all_id($this->q_all->getTCul(), $this->b_all->getTCul());
    }
}
