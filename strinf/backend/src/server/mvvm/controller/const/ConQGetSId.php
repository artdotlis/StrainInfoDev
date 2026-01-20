<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\mvvm\controller\const;

use straininfo\server\interfaces\mvvm\view_model\chan\cache\CaVMIntSeaId;
use straininfo\server\interfaces\mvvm\view_model\chan\query\QVMIntSeaId;

/**
 * @template T of string|int
 */
final class ConQGetSId
{
    /**
     * @param QVMIntSeaId<T> $con_q_s
     * @param CaVMIntSeaId<T> $con_b_s
     */
    public function __construct(
        private readonly QVMIntSeaId $con_q_s,
        private readonly CaVMIntSeaId $con_b_s
    ) {
    }

    /** @return QVMIntSeaId<T> */
    public function getQS(): QVMIntSeaId
    {
        return $this->con_q_s;
    }

    /** @return CaVMIntSeaId<T> */
    public function getBS(): CaVMIntSeaId
    {
        return $this->con_b_s;
    }
}
