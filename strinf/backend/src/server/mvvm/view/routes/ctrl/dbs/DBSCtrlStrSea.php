<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\view\routes\ctrl\dbs;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;
use straininfo\server\interfaces\mvvm\view\chan\QVIntSeaIdStr;
use function straininfo\server\shared\mvvm\view\api\is_sea_str_api_pr;
use straininfo\server\shared\mvvm\view\api\query\v1\QSeaStrIE as QSeaStrIEV1;
use straininfo\server\shared\mvvm\view\api\query\v2\QSeaStrIE as QSeaStrIEV2;

use straininfo\server\shared\mvvm\view\StatArgs;

final class DBSCtrlStrSea extends DBSCtrl
{
    private readonly QVIntSeaIdStr $q_chan;

    /**
     * @param array<string> $cors
     * @param array<string> $private
     */
    public function __construct(
        QVIntSeaIdStr $q_chan,
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
    public function getSeq(
        QSeaStrIEV1 | QSeaStrIEV2 $path,
        QSeaStrIEV1 | QSeaStrIEV2 $arg_name,
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface {
        $this->checkPrivate($request, is_sea_str_api_pr($path));
        [$res, $emp] = $this->q_chan->getSeqAcc($args[$arg_name->value]);
        return $this->parseJson($request, $response, $res, $emp);
    }

    /** @param array<string> $args */
    public function getStrDes(
        QSeaStrIEV1 | QSeaStrIEV2 $path,
        QSeaStrIEV1 | QSeaStrIEV2 $arg_name,
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface {
        $this->checkPrivate($request, is_sea_str_api_pr($path));
        [$res, $emp] = $this->q_chan->getStrDes($args[$arg_name->value]);
        return $this->parseJson($request, $response, $res, $emp);
    }

    /** @param array<string> $args */
    public function getBrc(
        QSeaStrIEV1 | QSeaStrIEV2 $path,
        QSeaStrIEV1 | QSeaStrIEV2 $arg_name,
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface {
        $this->checkPrivate($request, is_sea_str_api_pr($path));
        [$res, $emp] = $this->q_chan->getBrc($args[$arg_name->value]);
        return $this->parseJson($request, $response, $res, $emp);
    }

    /** @param array<string> $args */
    public function getCulId(
        QSeaStrIEV1 | QSeaStrIEV2 $path,
        QSeaStrIEV1 | QSeaStrIEV2 $arg_name,
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface {
        $this->checkPrivate($request, is_sea_str_api_pr($path));
        [$res, $emp] = $this->q_chan->getCulId($args[$arg_name->value]);
        return $this->parseJson($request, $response, $res, $emp);
    }

    /** @param array<string> $args */
    public function getTaxName(
        QSeaStrIEV1 | QSeaStrIEV2 $path,
        QSeaStrIEV1 | QSeaStrIEV2 $arg_name,
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface {
        $this->checkPrivate($request, is_sea_str_api_pr($path));
        [$res, $emp] = $this->q_chan->getTaxName($args[$arg_name->value]);
        return $this->parseJson($request, $response, $res, $emp);
    }

    /** @param array<string> $args */
    public function getStrNo(
        QSeaStrIEV1 | QSeaStrIEV2 $path,
        QSeaStrIEV1 | QSeaStrIEV2 $arg_name,
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface {
        $this->checkPrivate($request, is_sea_str_api_pr($path));
        [$res, $emp] = $this->q_chan->getStrNo($args[$arg_name->value]);
        return $this->parseJson($request, $response, $res, $emp);
    }
}
