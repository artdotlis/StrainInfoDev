<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\mvvm\view_model\chan\stat\query;

/** @extends QVMChanDis<int> */
final class QVMChanCPSCnt extends QVMChanDis
{
    /** @return array<string, array<int>> */
    public function getResult(): array
    {
        return $this->getMChan()->getCulPStrCnt();
    }
}
