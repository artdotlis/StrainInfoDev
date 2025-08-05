<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\model\chan\cache;

use straininfo\server\shared\mvvm\model\redis\RedisStE;
use straininfo\server\mvvm\model\chan\RedisMWr;
use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntSeaIdSet;

abstract class CaRSeaSet extends RedisMWr implements CaMIntSeaIdSet
{
    protected readonly int $ex_s;
    protected readonly int $tmp_s;
    protected readonly int $limit;

    /** @param callable(): \Redis|null $dbc */
    public function __construct(
        ?callable $dbc,
        int $ex_h,
        int $tmp_h,
        int $limit
    ) {
        $this->ex_s = 3_600 * $ex_h;
        $this->tmp_s = 3_600 * $tmp_h;
        $this->limit = $limit;
        parent::__construct($dbc, true);
    }

    /** @param array<string, array<int>> $str_des */
    public function setStrDes(array $str_des): void
    {
        $this->setSea($str_des, $this->wrId(RedisStE::STR_DES->value), $this->ex_s);
    }

    /** @param array<string, array<int>> $seq_acc */
    public function setSeqAcc(array $seq_acc): void
    {
        $this->setSea($seq_acc, $this->wrId(RedisStE::SEQ->value), $this->ex_s);
    }

    /** @param array<string, array<int>> $tax_name */
    public function setTaxName(array $tax_name): void
    {
        $this->setSea($tax_name, $this->wrId(RedisStE::TAX_NAM->value), $this->tmp_s);
    }

    /** @param array<string, array<int>> $str_no */
    public function setStrNo(array $str_no): void
    {
        $this->setSea($str_no, $this->wrId(RedisStE::STR_NO->value), $this->ex_s);
    }

    /** @param array<string, array<int>> $brc */
    public function setBrc(array $brc): void
    {
        $this->setSea($brc, $this->wrId(RedisStE::BRC->value), $this->ex_s);
    }

    abstract protected function wrId(string $id): string;

    /**
     * @template T of string|int
     *
     * @param array<T, array<int>> $data
     */
    protected function setSea(array $data, string $dbn, int $ex_s): void
    {
        $this->checkMaintenanceMode();
        if (count($data) < $this->limit) {
            $this->runPipe($data, $dbn, $ex_s);
        }
    }

    /**
     * @template T of string|int
     *
     * @param array<T, array<int>> $data
     */
    protected function runPipe(array $data, string $dbn, int $ex_s): void
    {
        $lim = $this->limit;
        $pipe = $this->getDBC()->pipeline();
        foreach ($data as $id => $ids) {
            if (count($ids) < $lim) {
                $pipe = $pipe->set($dbn . $id, implode(",", $ids), ['EX' => $ex_s]);
            }
        }
        $pipe->exec();
    }
}
