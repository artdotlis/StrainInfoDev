<?php

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\view\chan;

interface QVIntSeaId
{
    /** @return array{string, bool} */
    public function getSeqAcc(string $seq_acc): array;

    /** @return array{string, bool} */
    public function getStrNo(string $str_no): array;

    /** @return array{string, bool} */
    public function getTaxName(string $tax_name): array;

    /** @return array{string, bool} */
    public function getStrDes(string $str_des): array;

    /** @return array{string, bool} */
    public function getBrc(string $brc): array;
}
