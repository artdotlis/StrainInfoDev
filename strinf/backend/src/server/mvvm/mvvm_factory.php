<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\mvvm;

use straininfo\server\mvvm\view_model\MainViewModel;
use straininfo\server\mvvm\view\MainView;
use straininfo\server\mvvm\model\MainModel;
use straininfo\server\mvvm\controller\MainCtrl;
use straininfo\server\interfaces\mvvm\controller\CtrlIntBoot;
use straininfo\server\configs\ConfigsCont;
use Psr\Log\LoggerInterface;

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
