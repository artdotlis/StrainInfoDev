<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\mvvm\view\routes\ctrl\dbs;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;
use straininfo\server\interfaces\mvvm\view\chan\QVIntOptSea;
use function straininfo\server\shared\mvvm\view\api\is_sea_opt_api_pr;
use straininfo\server\shared\mvvm\view\api\query\service\QOptSeaE;

use straininfo\server\shared\mvvm\view\StatArgs;

final class DBSCtrlSeaOpt extends DBSCtrl
{
    private readonly QVIntOptSea $q_chan;

    /**
     * @param array<string> $cors
     * @param array<string> $private
     */
    public function __construct(
        QVIntOptSea $q_chan,
        string $charset,
        array $cors,
        array $private,
        StatArgs $stat_args,
        LoggerInterface $logger
    ) {
        $this->q_chan = $q_chan;
        parent::__construct($charset, $cors, $private, $stat_args, $logger);
    }

    /** @param array<string> $args */
    public function getIndByKey(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface {
        $this->checkPrivate($request, is_sea_opt_api_pr(QOptSeaE::IND_ENT));
        [$res, $emp] = $this->q_chan->getIndexKey($args[QOptSeaE::IND_ENT_P->value]);
        return $this->parseJson($request, $response, $res, $emp);
    }
    /** @param array<string> $args */
    public function getSeaMicAll(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface {
        $this->checkPrivate($request, is_sea_opt_api_pr(QOptSeaE::SEA_ALL_ENT));
        $ind = intval($args[QOptSeaE::SEA_ALL_ENT_P->value], 10);
        [$res, $emp] = $this->q_chan->getSeaMicAll($ind);
        return $this->parseJson($request, $response, $res, $emp);
    }
    /** @param array<string> $args */
    public function getSeaMic(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface {
        $this->checkPrivate($request, is_sea_opt_api_pr(QOptSeaE::SEA_ENT));
        [$res, $emp] = $this->q_chan->getSeaMic($args[QOptSeaE::SEA_ENT_P->value]);
        return $this->parseJson($request, $response, $res, $emp);
    }
}
