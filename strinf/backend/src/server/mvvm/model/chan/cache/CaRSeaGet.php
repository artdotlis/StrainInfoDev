<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\model\chan\cache;

use Predis\Pipeline\Pipeline;
use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntSeaId;
use straininfo\server\mvvm\model\chan\RedisMWr;
use straininfo\server\shared\mvvm\model\redis\RedisStE;

abstract class CaRSeaGet extends RedisMWr implements CaMIntSeaId
{
    /** @param callable(): \Predis\Client|null $dbc */
    public function __construct(?callable $dbc)
    {
        parent::__construct($dbc, true);
    }

    /**
     * @param array<string> $str_des
     *
     * @return array<string, array<int>>
     */
    public function getStrDes(array $str_des): array
    {
        return $this->getCulIds($str_des, $this->wrId(RedisStE::STR_DES->value));
    }

    /**
     * @param array<string> $seq_acc
     *
     * @return array<string, array<int>>
     */
    public function getSeqAcc(array $seq_acc): array
    {
        return $this->getCulIds($seq_acc, $this->wrId(RedisStE::SEQ->value));
    }

    /**
     * @param array<string> $tax_name
     *
     * @return array<string, array<int>>
     */
    public function getTaxName(array $tax_name): array
    {
        return $this->getCulIds($tax_name, $this->wrId(RedisStE::TAX_NAM->value));
    }

    /**
     * @param array<string> $str_no
     *
     * @return array<string, array<int>>
     */
    public function getStrNo(array $str_no): array
    {
        return $this->getCulIds($str_no, $this->wrId(RedisStE::STR_NO->value));
    }

    /**
     * @param array<string> $str_no
     *
     * @return array<string, array<int>>
     */
    public function getBrc(array $str_no): array
    {
        return $this->getCulIds($str_no, $this->wrId(RedisStE::BRC->value));
    }
    abstract protected function wrId(string $id): string;

    /**
     * @template T of string|int
     *
     * @param array<T> $ids
     *
     * @return array<T, array<int>>
     */
    protected function getCulIds(array $ids, string $dbn): array
    {
        $this->checkMaintenanceMode();
        $res = $this->getDBC()->pipeline(
            static function (Pipeline $red) use ($ids, $dbn): void {
                foreach ($ids as $id) {
                    $red->lrange($dbn . $id, 0, -1);
                }
            }
        );
        if (is_array($res)) {
            return array_combine($ids, $res);
        }
        return [];
    }
}
