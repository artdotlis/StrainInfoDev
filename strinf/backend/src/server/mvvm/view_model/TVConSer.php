<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\mvvm\view_model;

use straininfo\server\interfaces\mvvm\model\chan\con\ToViewIntMCaGet;
use straininfo\server\interfaces\mvvm\model\chan\con\ToViewIntMCaSet;
use straininfo\server\interfaces\mvvm\model\chan\con\ToViewIntMInd;
use straininfo\server\interfaces\mvvm\model\chan\con\ToViewIntMQ;
use straininfo\server\interfaces\mvvm\view_model\TVConSerInt;
use straininfo\server\mvvm\view_model\chan\con\cache\ChanVMAllCa;
use straininfo\server\mvvm\view_model\chan\con\cache\ChanVMArcCa;
use straininfo\server\mvvm\view_model\chan\con\cache\ChanVMStatCa;
use straininfo\server\mvvm\view_model\chan\con\index\ChanVMSeaIn;
use straininfo\server\mvvm\view_model\chan\con\query\ChanVMAllQ;
use straininfo\server\mvvm\view_model\chan\con\query\ChanVMArcQ;
use straininfo\server\mvvm\view_model\chan\con\query\ChanVMStatQ;

/**
 * @implements TVConSerInt<int>
 */
final class TVConSer implements TVConSerInt
{
    private ChanVMAllQ $q_all;
    private ChanVMAllCa $b_all;

    private ChanVMStatQ $q_stat;
    private ChanVMStatCa $b_stat;

    private ChanVMArcQ $q_arc;
    private ChanVMArcCa $b_arc;

    private ChanVMSeaIn $i_ind;

    private readonly string $chm;
    private readonly string $chv;
    private readonly int $k_len;
    private readonly ToViewIntMCaGet $get;
    private readonly ToViewIntMCaSet $set;

    /**
     * @var ToViewIntMQ<array<string, object>, array<string, object>>
     */
    private readonly ToViewIntMQ $mtv_d;
    private readonly ToViewIntMInd $mtv_i;

    /**
     * @param array{get: ToViewIntMCaGet, set: ToViewIntMCaSet} $cache
     * @param array{db: ToViewIntMQ<array<string, object>, array<string, object>>, in: ToViewIntMInd} $data
     */
    public function __construct(
        string $chm,
        string $chv,
        int $k_len,
        array $cache,
        array $data
    ) {
        $this->get = $cache['get'];
        $this->set = $cache['set'];
        $this->mtv_d = $data['db'];
        $this->mtv_i = $data['in'];
        $this->chm = $chm;
        $this->chv = $chv;
        $this->k_len = $k_len;
        $this->createVMAll();
        $this->createVMDis();
        $this->createVMArc();
        $this->createVMInd();
    }

    public function getToViewOptSeaChanSea(): ChanVMSeaIn
    {
        return $this->i_ind;
    }

    public function getToViewQChanAll(): ChanVMAllQ
    {
        return $this->q_all;
    }

    public function getToViewCaChanAll(): ChanVMAllCa
    {
        return $this->b_all;
    }

    public function getToViewCaChanStat(): ChanVMStatCa
    {
        return $this->b_stat;
    }

    public function getToViewQChanStat(): ChanVMStatQ
    {
        return $this->q_stat;
    }

    public function getToViewQChanArc(): ChanVMArcQ
    {
        return $this->q_arc;
    }

    public function getToViewCaChanArc(): ChanVMArcCa
    {
        return $this->b_arc;
    }

    private function createVMAll(): void
    {
        $this->b_all = new ChanVMAllCa($this->get, $this->set, $this->chm, $this->chv);
        $this->q_all = new ChanVMAllQ($this->mtv_d, $this->chm, $this->chv);
    }

    private function createVMDis(): void
    {
        $this->q_stat = new ChanVMStatQ($this->mtv_d, $this->chm, $this->chv);
        $this->b_stat = new ChanVMStatCa($this->get, $this->set, $this->chm, $this->chv);
    }

    private function createVMArc(): void
    {
        $this->q_arc = new ChanVMArcQ($this->mtv_d, $this->chm, $this->chv);
        $this->b_arc = new ChanVMArcCa($this->get, $this->set, $this->chm, $this->chv);
    }

    private function createVMInd(): void
    {
        $this->i_ind = new ChanVMSeaIn(
            $this->mtv_i,
            $this->get->getCaMStr(),
            $this->set->getCaMStr(),
            $this->k_len,
            $this->chm,
            $this->chv
        );
    }
}
