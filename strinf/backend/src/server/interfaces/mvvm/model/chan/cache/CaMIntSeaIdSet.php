<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\model\chan\cache;

use straininfo\server\interfaces\mvvm\model\chan\MainChannel;

interface CaMIntSeaIdSet extends MainChannel
{
    /** @param array<string, array<int>> $seq_acc */
    public function setSeqAcc(array $seq_acc): void;

    /** @param array<string, array<int>> $str_des */
    public function setStrDes(array $str_des): void;

    /** @param array<string, array<int>> $tax_name */
    public function setTaxName(array $tax_name): void;

    /** @param array<string, array<int>> $str_no */
    public function setStrNo(array $str_no): void;

    /** @param array<string, array<int>> $brc */
    public function setBrc(array $brc): void;
}
