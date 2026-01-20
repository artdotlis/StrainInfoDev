<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\mvvm\view\routes\ctrl\dbs;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;
use straininfo\server\interfaces\mvvm\view\chan\QVIntStat;
use function straininfo\server\shared\mvvm\view\api\is_stat_api_pr;
use straininfo\server\shared\mvvm\view\api\query\service\QStatE;

use straininfo\server\shared\mvvm\view\StatArgs;

final class DBSCtrlStat extends DBSCtrl
{
    private readonly QVIntStat $q_chan;

    /**
     * @param array<string> $cors
     * @param array<string> $private
     */
    public function __construct(
        QVIntStat $q_chan,
        string $charset,
        array $cors,
        array $private,
        StatArgs $stat_args,
        LoggerInterface $logger
    ) {
        $this->q_chan = $q_chan;
        parent::__construct($charset, $cors, $private, $stat_args, $logger);
    }

    public function getDisCPSCnt(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        $this->checkPrivate($request, is_stat_api_pr(QStatE::DPS_CNT));
        $res = $this->q_chan->getCulPStrCnt();
        return $this->parseJson($request, $response, $res, false, true);
    }
}
