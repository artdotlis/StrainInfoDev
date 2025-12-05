<?php

declare(strict_types=1);

namespace straininfo\server\cron\cache;

use Psr\Log\LoggerInterface;
use straininfo\server\configs\ConfigsCont;
use straininfo\server\mvvm\controller\MainCtrl;
use straininfo\server\mvvm\model\MainModel;
use straininfo\server\mvvm\view\MainView;
use straininfo\server\mvvm\view_model\MainViewModel;

use function Safe\ini_get;
use function Safe\ini_set;
use function straininfo\server\exceptions\get_err_handler_slim_fun;
use function straininfo\server\logger\create_logger;
use function straininfo\server\mvvm\controller\const\sea_mic_all;

final class SearchCache
{
    // immutable
    private readonly LoggerInterface $logger_err;
    private readonly ConfigsCont $configurations;

    private ?MainViewModel $main_vm;

    public function __construct()
    {
        $this->main_vm = null;
        $this->configurations = ConfigsCont::getConfigsCon('_search_cache_creation');
        $this->logger_err = create_logger($this->configurations->getLoggerArgs(), 10);
        set_exception_handler(get_err_handler_slim_fun($this->logger_err));
    }

    public function start(): void
    {
        try {
            $mem = ini_get('memory_limit');
            $new_mem = '1024M';
            printf('START - ' . $mem . ' -> ' . $new_mem . "\n");
            ini_set('memory_limit', $new_mem);

            $done = false;
            $index = 0;
            $mvm = $this->getViewModel();
            while (!$done) {
                $done = $this->runSeaMicCall($index, $mvm);
                $index++;
                printf('FINISHED ' . $index . "\n");
            }
            printf("FINISHED\n");
            $mvm->stop();
        } catch (\Throwable $ex) {
            echo $ex;
        }
    }

    private function getViewModel(): MainViewModel
    {
        if ($this->main_vm === null) {
            $this->main_vm = new MainViewModel(new MainModel(
                $this->configurations->getDBArgs(),
                $this->configurations->getRedisArgs(),
                $this->configurations->getIndexArgs(),
                $this->configurations->getModelArgs()
            ));
            new MainCtrl(new MainView(
                $this->logger_err,
                $this->configurations->getWebArgsBE(),
                $this->configurations->getWebArgsFE(),
                $this->configurations->getStatArgs(),
                $this->configurations->getVersion()
            ), $this->main_vm);
            $this->main_vm->start();
            $this->main_vm->setSuccess();
        }
        return $this->main_vm;
    }

    private static function runSeaMicCall(int $index, MainViewModel $mvm): bool
    {
        $sea_opt = $mvm->getToViewSerCon()->getToViewOptSeaChanSea();
        $all_q = $mvm->getToViewSerCon()->getToViewQChanAll();
        $all_b = $mvm->getToViewSerCon()->getToViewCaChanAll();
        $str_q = $mvm->getToViewVerCon()->getToViewQChanStr();
        $str_b = $mvm->getToViewVerCon()->getToViewCaChanStr();
        return sea_mic_all(
            $index,
            $all_q->getVMStr(),
            $all_b->getVMStr(),
            $str_q->getVMMin(),
            $str_b->getVMMin(),
            $sea_opt->getVMSeaMic(),
            $sea_opt->getVMOptSea()
        )[1];
    }
}
