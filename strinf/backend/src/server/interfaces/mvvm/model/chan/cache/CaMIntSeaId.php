<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\model\chan\cache;

use straininfo\server\interfaces\mvvm\model\chan\MainChannel;

interface CaMIntSeaId extends MainChannel
{
    /**
     * @param array<string> $str_des
     *
     * @return array<string, string>
     */
    public function getStrDes(array $str_des): array;

    /**
     * @param array<string> $seq_acc
     *
     * @return array<string, string>
     */
    public function getSeqAcc(array $seq_acc): array;

    /**
     * @param array<string> $str_no
     *
     * @return array<string, string>
     */
    public function getStrNo(array $str_no): array;

    /**
     * @param array<string> $tax_name
     *
     * @return array<string, string>
     */
    public function getTaxName(array $tax_name): array;

    /**
     * @param array<string> $brc
     *
     * @return array<string, string>
     */
    public function getBrc(array $brc): array;
}
