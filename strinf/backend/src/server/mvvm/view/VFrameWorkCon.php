<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\mvvm\view;

use Psr\Log\LoggerInterface;
use Slim\App;
use Slim\Factory\AppFactory;
use straininfo\server\mvvm\view\routes\RoutesMain;
use straininfo\server\shared\mvvm\view\StatArgs;
use straininfo\server\shared\mvvm\view\WebArgsBE;
use straininfo\server\shared\mvvm\view\WebArgsFE;

final class VFrameWorkCon
{
    private readonly LoggerInterface $logger;
    private readonly RoutesMain $m_routes;

    /** @var App<\Psr\Container\ContainerInterface|null> */
    private App $slim_app;

    public function __construct(
        LoggerInterface $logger,
        WebArgsBE $wbe_args,
        WebArgsFE $wfe_args,
        StatArgs $stat_args,
        string $version
    ) {
        $this->m_routes = new RoutesMain($wbe_args, $wfe_args, $stat_args, $version);
        $this->logger = $logger;
    }

    public function getWebArgs(): WebArgsBE
    {
        return $this->m_routes->getWebArgs();
    }

    public function run(): void
    {
        $this->slim_app->run();
    }

    public function initSlim(ToViewChanV $chant_to_view): void
    {
        $this->slim_app = AppFactory::create();
        $merr = $this->m_routes->initRoutes(
            $this->slim_app,
            $chant_to_view,
            $this->logger
        );
        $this->m_routes->addMaintenanceMW($merr);
        $this->slim_app->addRoutingMiddleware();
        $this->slim_app->addBodyParsingMiddleware();
        $this->m_routes->addErrorMW($this->slim_app, $this->logger);
        $this->m_routes->addShortMW($merr);
    }

    /** @return App<\Psr\Container\ContainerInterface|null> */
    public function getApp(): App
    {
        return $this->slim_app;
    }

    public function setMaintenance(
        ?\DateTime $finish_time,
        \DateTimeZone $zone,
        bool $maintenance
    ): void {
        $this->m_routes->setMaintenance($finish_time, $zone, $maintenance);
    }
}
