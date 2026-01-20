<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\mvvm\view_model\chan\arc\cache;

use straininfo\server\shared\mvvm\view_model\data\QDConIdEnt;

final class CaVMChanSIID extends CaVMChanArc
{
    /**
     * @param array<string> $arg
     *
     * @return QDConIdEnt<string>
     */
    public function getResult(array $arg): QDConIdEnt
    {
        $cul = $this->getMChan()->getArcBySiId($arg);
        return new QDConIdEnt(array_diff($arg, array_keys($cul)), $cul);
    }

    /** @param QDConIdEnt<string> $arc_con */
    public function setResult(QDConIdEnt $arc_con): void
    {
        if ($arc_con->getToBuf()) {
            $this->getMSetChan()->setArcBySiId($arc_con->getToBuf());
        }
    }
}
