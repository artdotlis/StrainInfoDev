<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\mvvm\view\routes\ctrl\dbs;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;
use straininfo\server\interfaces\mvvm\view\chan\QVIntCnt;
use function straininfo\server\shared\mvvm\view\api\is_cnt_api_pr;
use straininfo\server\shared\mvvm\view\api\query\v1\QCntE as QCntEV1;
use straininfo\server\shared\mvvm\view\api\query\v2\QCntE as QCntEV2;

use straininfo\server\shared\mvvm\view\StatArgs;

final class DBSCtrlCnt extends DBSCtrl
{
    private readonly QVIntCnt $q_chan;

    /**
     * @param array<string> $cors
     * @param array<string> $private
     */
    public function __construct(
        QVIntCnt $q_chan,
        string $charset,
        array $cors,
        array $private,
        StatArgs $stat_args,
        LoggerInterface $logger
    ) {
        $this->q_chan = $q_chan;
        parent::__construct($charset, $cors, $private, $stat_args, $logger);
    }

    public function getStrainCount(
        QCntEV1 | QCntEV2 $path,
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        $this->checkPrivate($request, is_cnt_api_pr($path));
        $res = $this->q_chan->getStrainCount();
        return $this->parseJson($request, $response, $res, false, true);
    }

    public function getArchiveCount(
        QCntEV1 | QCntEV2 $path,
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        $this->checkPrivate($request, is_cnt_api_pr($path));
        $res = $this->q_chan->getArchiveCount();
        return $this->parseJson($request, $response, $res, false, true);
    }

    public function getTypeStrainCount(
        QCntEV1 | QCntEV2 $path,
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        $this->checkPrivate($request, is_cnt_api_pr($path));
        $res = $this->q_chan->getTypeStrainCount();
        return $this->parseJson($request, $response, $res, false, true);
    }

    public function getTypeCultureCount(
        QCntEV1 | QCntEV2 $path,
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        $this->checkPrivate($request, is_cnt_api_pr($path));
        $res = $this->q_chan->getTypeCultureCount();
        return $this->parseJson($request, $response, $res, false, true);
    }

    public function getDesignationCount(
        QCntEV1 | QCntEV2 $path,
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        $this->checkPrivate($request, is_cnt_api_pr($path));
        $res = $this->q_chan->getDesignationCount();
        return $this->parseJson($request, $response, $res, false, true);
    }

    public function getSpeciesCount(
        QCntEV1 | QCntEV2 $path,
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        $this->checkPrivate($request, is_cnt_api_pr($path));
        $res = $this->q_chan->getSpeciesCount();
        return $this->parseJson($request, $response, $res, false, true);
    }

    public function getCultureCount(
        QCntEV1 | QCntEV2 $path,
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        $this->checkPrivate($request, is_cnt_api_pr($path));
        $res = $this->q_chan->getCultureCount();
        return $this->parseJson($request, $response, $res, false, true);
    }
}
