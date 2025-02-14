<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\view_model;

use straininfo\server\interfaces\mvvm\model\chan\con\ToViewIntMCaGet;
use straininfo\server\interfaces\mvvm\model\chan\con\ToViewIntMCaSet;
use straininfo\server\interfaces\mvvm\model\chan\con\ToViewIntMQ;
use straininfo\server\interfaces\mvvm\view_model\TVConVerInt;
use straininfo\server\mvvm\view_model\chan\con\cache\ChanVMCntCa;
use straininfo\server\mvvm\view_model\chan\con\cache\ChanVMCulSeaCa;
use straininfo\server\mvvm\view_model\chan\con\cache\ChanVMDatCa;
use straininfo\server\mvvm\view_model\chan\con\cache\ChanVMStrSeaCa;
use straininfo\server\mvvm\view_model\chan\con\query\ChanVMCntQ;
use straininfo\server\mvvm\view_model\chan\con\query\ChanVMCulQ;
use straininfo\server\mvvm\view_model\chan\con\query\ChanVMCulSeaQ;
use straininfo\server\mvvm\view_model\chan\con\query\ChanVMStrQ;
use straininfo\server\mvvm\view_model\chan\con\query\ChanVMStrSeaQ;

/**
 * @phpstan-type ParCul \straininfo\server\shared\mvvm\view_model\data\ParCul
 * @phpstan-type ParStr \straininfo\server\shared\mvvm\view_model\data\ParStr
 *
 * @implements TVConVerInt<ParCul, ParStr>
 */
final class TVConVer implements TVConVerInt
{
    private ChanVMCntQ $q_cnt;
    private ChanVMCntCa $b_cnt;

    private ChanVMCulSeaQ $q_cul_sea;
    private ChanVMCulSeaCa $b_cul_sea;

    private ChanVMStrSeaQ $q_str_sea;
    private ChanVMStrSeaCa $b_str_sea;

    private ChanVMCulQ $q_cul;
    private ChanVMDatCa $b_cul;

    private ChanVMStrQ $q_str;
    private ChanVMDatCa $b_str;

    private readonly string $chm;
    private readonly string $chv;
    private readonly ToViewIntMCaGet $get;
    private readonly ToViewIntMCaSet $set;

    /** @var ToViewIntMQ<array<string, object>, array<string, object>> */
    private readonly ToViewIntMQ $mtv;

    /**
     * @param ToViewIntMQ<array<string, object>, array<string, object>> $mtv
     */
    public function __construct(
        string $chm,
        string $chv,
        ToViewIntMCaGet $get,
        ToViewIntMCaSet $set,
        ToViewIntMQ $mtv
    ) {
        $this->get = $get;
        $this->set = $set;
        $this->mtv = $mtv;
        $this->chm = $chm;
        $this->chv = $chv;
        $this->createVMCnt();
        $this->createVMCulSea();
        $this->createVMStrSea();
        $this->createVMCul();
        $this->createVMStr();
    }

    public function getToViewQChanCnt(): ChanVMCntQ
    {
        return $this->q_cnt;
    }

    public function getToViewCaChanCnt(): ChanVMCntCa
    {
        return $this->b_cnt;
    }

    public function getToViewQChanCulSea(): ChanVMCulSeaQ
    {
        return $this->q_cul_sea;
    }

    public function getToViewCaChanCulSea(): ChanVMCulSeaCa
    {
        return $this->b_cul_sea;
    }

    public function getToViewQChanStrSea(): ChanVMStrSeaQ
    {
        return $this->q_str_sea;
    }

    public function getToViewCaChanStrSea(): ChanVMStrSeaCa
    {
        return $this->b_str_sea;
    }

    public function getToViewQChanCul(): ChanVMCulQ
    {
        return $this->q_cul;
    }

    public function getToViewCaChanCul(): ChanVMDatCa
    {
        return $this->b_cul;
    }

    public function getToViewQChanStr(): ChanVMStrQ
    {
        return $this->q_str;
    }

    public function getToViewCaChanStr(): ChanVMDatCa
    {
        return $this->b_str;
    }

    private function createVMCnt(): void
    {
        $this->q_cnt = new ChanVMCntQ($this->mtv, $this->chm, $this->chv);
        $this->b_cnt = new ChanVMCntCa($this->get, $this->set, $this->chm, $this->chv);
    }

    private function createVMCul(): void
    {
        $this->q_cul = new ChanVMCulQ(
            $this->mtv->getQMCul(),
            $this->chm,
            $this->chv
        );
        $this->b_cul = new ChanVMDatCa(
            $this->get->getCaMCul(),
            $this->set->getCaMCul(),
            $this->chm,
            $this->chv
        );
    }

    private function createVMStr(): void
    {
        $this->q_str = new ChanVMStrQ(
            $this->mtv->getQMStr(),
            $this->chm,
            $this->chv
        );
        $this->b_str = new ChanVMDatCa(
            $this->get->getCaMStr(),
            $this->set->getCaMStr(),
            $this->chm,
            $this->chv
        );
    }

    private function createVMCulSea(): void
    {
        $this->q_cul_sea = new ChanVMCulSeaQ($this->mtv, $this->chm, $this->chv);
        $this->b_cul_sea = new ChanVMCulSeaCa(
            $this->get,
            $this->set,
            $this->chm,
            $this->chv
        );
    }

    private function createVMStrSea(): void
    {
        $this->q_str_sea = new ChanVMStrSeaQ($this->mtv, $this->chm, $this->chv);
        $this->b_str_sea = new ChanVMStrSeaCa(
            $this->get,
            $this->set,
            $this->chm,
            $this->chv
        );
    }
}
