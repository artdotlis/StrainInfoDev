<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\controller\chan;

use straininfo\server\interfaces\mvvm\controller\chan\QCIntSeaStrId;
use straininfo\server\mvvm\controller\const\ConCtrlSeaStr;
use straininfo\server\mvvm\controller\const\ConQGetSId;

use function straininfo\server\mvvm\controller\const\search_ent_id;

final class QCChanSeaStr implements QCIntSeaStrId
{
    /**
     * @param ConCtrlSeaStr<\straininfo\server\interfaces\mvvm\view_model\chan\query\QVMIntSeaId<int>, \straininfo\server\interfaces\mvvm\view_model\chan\query\QVMIntSeaId<string>> $con_q
     * @param ConCtrlSeaStr<\straininfo\server\interfaces\mvvm\view_model\chan\cache\CaVMIntSeaId<int>, \straininfo\server\interfaces\mvvm\view_model\chan\cache\CaVMIntSeaId<string>> $con_b
     */
    public function __construct(
        private readonly ConCtrlSeaStr $con_q,
        private readonly ConCtrlSeaStr $con_b
    ) {
    }

    /** @return array{string, bool} */
    public function getSeqAcc(string $seq_acc): array
    {
        return search_ent_id(
            $seq_acc,
            new ConQGetSId(
                $this->con_q->getSeq(),
                $this->con_b->getSeq()
            )
        );
    }

    /** @return array{string, bool} */
    public function getStrDes(string $str_des): array
    {
        return search_ent_id(
            $str_des,
            new ConQGetSId(
                $this->con_q->getStrDes(),
                $this->con_b->getStrDes()
            )
        );
    }

    /** @return array{string, bool} */
    public function getBrc(string $str_des): array
    {
        return search_ent_id(
            $str_des,
            new ConQGetSId(
                $this->con_q->getBrc(),
                $this->con_b->getBrc()
            )
        );
    }

    /** @return array{string, bool} */
    public function getStrNo(string $str_no): array
    {
        return search_ent_id(
            $str_no,
            new ConQGetSId(
                $this->con_q->getStrNo(),
                $this->con_b->getStrNo()
            )
        );
    }

    /** @return array{string, bool} */
    public function getTaxName(string $tax_name): array
    {
        return search_ent_id(
            $tax_name,
            new ConQGetSId(
                $this->con_q->getTaxName(),
                $this->con_b->getTaxName()
            )
        );
    }

    /** @return array{string, bool} */
    public function getCulId(string $cul_id): array
    {
        return search_ent_id(
            $cul_id,
            new ConQGetSId(
                $this->con_q->getCul(),
                $this->con_b->getCul()
            )
        );
    }
}
