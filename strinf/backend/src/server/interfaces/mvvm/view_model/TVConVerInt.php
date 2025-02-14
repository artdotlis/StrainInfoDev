<?php

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\view_model;

use straininfo\server\interfaces\mvvm\view_model\chan\con\ToViewIntVMCnt;
use straininfo\server\interfaces\mvvm\view_model\chan\con\ToViewIntVMDat;
use straininfo\server\interfaces\mvvm\view_model\chan\con\ToViewIntVMSeaCul;
use straininfo\server\interfaces\mvvm\view_model\chan\con\ToViewIntVMSeaStr;

/**
 * @template TC
 * @template TS
 */
interface TVConVerInt
{
    /**
     * @return ToViewIntVMDat<null, \straininfo\server\interfaces\mvvm\view_model\chan\cache\CaVMIntDat>
     */
    public function getToViewCaChanCul(): ToViewIntVMDat;

    /**
     * @return ToViewIntVMDat<null, \straininfo\server\interfaces\mvvm\view_model\chan\cache\CaVMIntDat>
     */
    public function getToViewCaChanStr(): ToViewIntVMDat;

    /**
     * @return ToViewIntVMSeaCul<\straininfo\server\interfaces\mvvm\view_model\chan\cache\CaVMIntSeaId<int>, \straininfo\server\interfaces\mvvm\view_model\chan\cache\CaVMIntSeaId<string>>
     */
    public function getToViewCaChanCulSea(): ToViewIntVMSeaCul;

    /**
     * @return ToViewIntVMSeaStr<\straininfo\server\interfaces\mvvm\view_model\chan\cache\CaVMIntSeaId<int>, \straininfo\server\interfaces\mvvm\view_model\chan\cache\CaVMIntSeaId<string>>
     */
    public function getToViewCaChanStrSea(): ToViewIntVMSeaStr;

    /**
     * @return ToViewIntVMCnt<\straininfo\server\interfaces\mvvm\view_model\chan\cache\CaVMIntCnt>
     */
    public function getToViewCaChanCnt(): ToViewIntVMCnt;

    /**
     * @return ToViewIntVMDat<TC, \straininfo\server\interfaces\mvvm\view_model\chan\query\QVMIntDat<TC>>
     */
    public function getToViewQChanCul(): ToViewIntVMDat;

    /**
     * @return ToViewIntVMDat<TS, \straininfo\server\interfaces\mvvm\view_model\chan\query\QVMIntDat<TS>>
     */
    public function getToViewQChanStr(): ToViewIntVMDat;

    /**
     * @return ToViewIntVMSeaCul<\straininfo\server\interfaces\mvvm\view_model\chan\query\QVMIntSeaId<int>, \straininfo\server\interfaces\mvvm\view_model\chan\query\QVMIntSeaId<string>>
     */
    public function getToViewQChanCulSea(): ToViewIntVMSeaCul;

    /**
     * @return ToViewIntVMSeaStr<\straininfo\server\interfaces\mvvm\view_model\chan\query\QVMIntSeaId<int>, \straininfo\server\interfaces\mvvm\view_model\chan\query\QVMIntSeaId<string>>
     */
    public function getToViewQChanStrSea(): ToViewIntVMSeaStr;

    /**
     * @return ToViewIntVMCnt<\straininfo\server\interfaces\mvvm\view_model\chan\query\QVMIntCnt>
     */
    public function getToViewQChanCnt(): ToViewIntVMCnt;
}
