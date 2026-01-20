<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\mvvm\view\routes\ctrl\dbs;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;
use straininfo\server\interfaces\mvvm\view\chan\QVIntAll;
use function straininfo\server\shared\mvvm\view\api\is_all_api_pr;
use straininfo\server\shared\mvvm\view\api\query\service\QAllE;

use straininfo\server\shared\mvvm\view\StatArgs;

final class DBSCtrlAll extends DBSCtrl
{
    private readonly QVIntAll $q_chan;

    /**
     * @param array<string> $cors
     * @param array<string> $private
     */
    public function __construct(
        QVIntAll $q_chan,
        string $charset,
        array $cors,
        array $private,
        StatArgs $stat_args,
        LoggerInterface $logger
    ) {
        $this->q_chan = $q_chan;
        parent::__construct($charset, $cors, $private, $stat_args, $logger);
    }

    public function getAllStrains(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        $this->checkPrivate($request, is_all_api_pr(QAllE::STR));
        $res = $this->q_chan->getAllStrId();
        return $this->parseJson($request, $response, $res, false);
    }

    public function getAllTStrains(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        $this->checkPrivate($request, is_all_api_pr(QAllE::STR_TYP));
        $res = $this->q_chan->getAllTStrId();
        return $this->parseJson($request, $response, $res, false);
    }

    public function getAllTCultures(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        $this->checkPrivate($request, is_all_api_pr(QAllE::CUL_TYP));
        $res = $this->q_chan->getAllTCulId();
        return $this->parseJson($request, $response, $res, false);
    }

    public function getAllCultures(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        $this->checkPrivate($request, is_all_api_pr(QAllE::CUL));
        $res = $this->q_chan->getAllCulId();
        return $this->parseJson($request, $response, $res, false);
    }
}
