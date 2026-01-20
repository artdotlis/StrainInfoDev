<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\mvvm\model\chan\cache;

use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntSeaId;
use straininfo\server\mvvm\model\chan\RedisMWr;
use straininfo\server\shared\mvvm\model\redis\RedisStE;

abstract class CaRSeaGet extends RedisMWr implements CaMIntSeaId
{
    /** @param callable(): \Redis|null $dbc */
    public function __construct(?callable $dbc)
    {
        parent::__construct($dbc, true);
    }

    /**
     * @param array<string> $str_des
     *
     * @return array<string, string>
     */
    public function getStrDes(array $str_des): array
    {
        return $this->getEntIds($str_des, $this->wrId(RedisStE::STR_DES->value));
    }

    /**
     * @param array<string> $seq_acc
     *
     * @return array<string, string>
     */
    public function getSeqAcc(array $seq_acc): array
    {
        return $this->getEntIds($seq_acc, $this->wrId(RedisStE::SEQ->value));
    }

    /**
     * @param array<string> $tax_name
     *
     * @return array<string, string>
     */
    public function getTaxName(array $tax_name): array
    {
        return $this->getEntIds($tax_name, $this->wrId(RedisStE::TAX_NAM->value));
    }

    /**
     * @param array<string> $str_no
     *
     * @return array<string, string>
     */
    public function getStrNo(array $str_no): array
    {
        return $this->getEntIds($str_no, $this->wrId(RedisStE::STR_NO->value));
    }

    /**
     * @param array<string> $str_no
     *
     * @return array<string, string>
     */
    public function getBrc(array $str_no): array
    {
        return $this->getEntIds($str_no, $this->wrId(RedisStE::BRC->value));
    }
    abstract protected function wrId(string $id): string;

    /**
     * @template T of string|int
     *
     * @param array<T> $ids
     *
     * @return array<T, string>
     */
    protected function getEntIds(array $ids, string $dbn): array
    {
        $this->checkMaintenanceMode();
        $pipe = $this->getDBC()->pipeline();
        foreach ($ids as $id) {
            $pipe = $pipe->get($dbn . $id);
        }
        $res = $pipe->exec();
        if (is_array($res)) {
            return array_filter(
                array_combine($ids, $res),
                static fn ($val) => \is_string($val)
            );
        }
        return [];
    }
}
