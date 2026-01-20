<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\mvvm\view_model\chan\all\query;

final class QVMChanTStr extends QVMChanAll
{
    /** @return array<int> */
    public function getResult(): array
    {
        return $this->getMChan()->getAllTStrIds();
    }
}
