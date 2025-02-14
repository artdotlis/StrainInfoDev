<?php

declare(strict_types=1);

namespace straininfo\server\cron\index;

use Psr\Log\LoggerInterface;
use function Safe\ini_get;
use function Safe\ini_set;
use function Safe\preg_split;
use straininfo\server\configs\ConfigsCont;

use function straininfo\server\exceptions\get_err_handler_slim_fun;
use function straininfo\server\logger\create_logger;
use straininfo\server\mvvm\model\dbs\ChIndEntDB;
use straininfo\server\mvvm\model\dbs\ChIndWrDB;
use function straininfo\server\shared\dbs\tryToConnect;
use straininfo\server\shared\mvvm\view\api\IndexEntity;
use function straininfo\server\shared\text\rm_taxon_name_ranks;

class SmartSearch
{
    // immutable
    private readonly LoggerInterface $logger_err;
    private readonly ConfigsCont $configurations;

    private ?ChIndEntDB $data;
    private ?ChIndWrDB $cache;

    public function __construct()
    {
        $this->data = null;
        $this->cache = null;
        $this->configurations = ConfigsCont::getConfigsCon('_smart_search_index');
        $conf = $this->configurations->getLoggerArgs();
        $this->logger_err = create_logger($conf, 10);
        set_exception_handler(get_err_handler_slim_fun($this->logger_err));
    }

    public function start(): void
    {
        try {
            $mem = ini_get('memory_limit');
            $new_mem = '512M';
            printf('START - ' . $mem . ' -> ' . $new_mem . "\n");
            ini_set('memory_limit', '512M');
            $no_spl = SmartSearch::noSplit(...);
            $tax_spl = SmartSearch::splitTaxa(...);
            $ent_con = $this->getDataDB()->getQDBEnt();
            $this->getCacheDB()->getIMEnt()->flushDB();
            $this->addRes($ent_con->getBRCSId(...), IndexEntity::BRC, $no_spl, true);
            $this->addRes($ent_con->getDesSId(...), IndexEntity::DES, $no_spl);
            $this->addRes($ent_con->getCcnoSId(...), IndexEntity::CCNO_DES, $no_spl);
            $this->addRes($ent_con->getSeqAccSId(...), IndexEntity::SEQ_ACC, $no_spl);
            $this->addRes($ent_con->getTaxonNSId(...), IndexEntity::TAX, $tax_spl, true);
            printf("FINISHED\n");
        } catch (\Throwable $ex) {
            echo $ex;
        }
    }

    private function getDataDB(): ChIndEntDB
    {
        if ($this->data === null) {
            $this->data = new ChIndEntDB($this->configurations->getDBArgs());
            tryToConnect($this->data->connect(...), 10);
        }
        return $this->data;
    }

    private function getCacheDB(): ChIndWrDB
    {
        if ($this->cache === null) {
            $this->cache = new ChIndWrDB($this->configurations->getIndexArgs());
            tryToConnect($this->cache->connect(...), 10);
        }
        return $this->cache;
    }

    /**
     * @param callable(): array<array{string, int, int}> $get_res
     * @param callable(string): array<string> $split
     */
    private function addRes(
        callable $get_res,
        IndexEntity $typ,
        callable $split,
        bool $ignore_length = false
    ): void {
        $cache_wr = $this->getCacheDB()->getIMEnt();
        $res = $get_res();
        $step = $typ->name;
        printf($step . ' - ' . count($res) . "\n");
        foreach ($res as [$key, $main, $count]) {
            $cache_wr->addSIdsEnt($typ, [$key, $main, $count], $split, $ignore_length);
        }
        unset($res);
        printf($step . " [FINISHED]\n");
    }

    /**
     * @return array<string>
     */
    private static function noSplit(string $key): array
    {
        (static fn ($val) => [$val])($key); // @phpstan-ignore expr.resultUnused
        return [];
    }

    /**
     * @return array<string>
     */
    private static function splitTaxa(string $taxon): array
    {
        return preg_split(
            '/\s+/',
            rm_taxon_name_ranks($taxon)
        );
    }
}
