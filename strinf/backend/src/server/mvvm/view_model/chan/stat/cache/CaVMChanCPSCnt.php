<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\mvvm\view_model\chan\stat\cache;

use straininfo\server\shared\mvvm\view_model\data\QDConJson;

final class CaVMChanCPSCnt extends CaVMChanStat
{
    public function setResult(QDConJson $all_con): void
    {
        $id_json = $all_con->getJson();
        if ($id_json) {
            $this->getMSetChan()->setCulPStrCnt($id_json);
        }
    }

    public function getResult(): QDConJson
    {
        $dis = $this->getMChan()->getCulPStrCnt();
        return new QDConJson(strlen($dis) > 0, $dis);
    }
}
