<?php

declare(strict_types=1);

namespace straininfo\server\mvvm;

use Psr\Log\LoggerInterface;
use straininfo\server\configs\ConfigsCont;
use straininfo\server\interfaces\mvvm\controller\CtrlIntBoot;
use straininfo\server\mvvm\controller\MainCtrl;
use straininfo\server\mvvm\model\MainModel;
use straininfo\server\mvvm\view\MainView;
use straininfo\server\mvvm\view_model\MainViewModel;

function create_mvvm(LoggerInterface $logger, ConfigsCont $conf): CtrlIntBoot
{
    $main_model = new MainModel(
        $conf->getDBArgs(),
        $conf->getRedisArgs(),
        $conf->getIndexArgs(),
        $conf->getModelArgs()
    );
    $main_view = new MainView(
        $logger,
        $conf->getWebArgsBE(),
        $conf->getWebArgsFE(),
        $conf->getStatArgs(),
        $conf->getVersion()
    );
    $main_vm = new MainViewModel($main_model);
    return new MainCtrl($main_view, $main_vm);
}
