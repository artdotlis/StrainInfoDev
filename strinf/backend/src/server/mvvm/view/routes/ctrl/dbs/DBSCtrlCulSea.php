<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\view\routes\ctrl\dbs;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;
use straininfo\server\interfaces\mvvm\view\chan\QVIntSeaIdCul;
use function straininfo\server\shared\mvvm\view\api\is_sea_cul_api_pr;
use straininfo\server\shared\mvvm\view\api\query\v1\QSeaCulIE as QSeaCulIEV1;
use straininfo\server\shared\mvvm\view\api\query\v2\QSeaDepIE as QSeaDepIEV2;

use straininfo\server\shared\mvvm\view\StatArgs;

final class DBSCtrlCulSea extends DBSCtrl
{
    private readonly QVIntSeaIdCul $q_chan;

    /**
     * @param array<string> $cors
     * @param array<string> $private
     */
    public function __construct(
        QVIntSeaIdCul $q_chan,
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
        QSeaCulIEV1 | QSeaDepIEV2 $path,
        QSeaCulIEV1 | QSeaDepIEV2 $arg_name,
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface {
        $this->checkPrivate($request, is_sea_cul_api_pr($path));
        [$res, $emp] = $this->q_chan->getSeqAcc($args[$arg_name->value]);
        return $this->parseJson($request, $response, $res, $emp);
    }

    /** @param array<string> $args */
    public function getStr(
        QSeaCulIEV1 | QSeaDepIEV2 $path,
        QSeaCulIEV1 | QSeaDepIEV2 $arg_name,
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface {
        $this->checkPrivate($request, is_sea_cul_api_pr($path));
        [$res, $emp] = $this->q_chan->getStrId($args[$arg_name->value]);
        return $this->parseJson($request, $response, $res, $emp);
    }

    /** @param array<string> $args */
    public function getStrDes(
        QSeaCulIEV1 | QSeaDepIEV2 $path,
        QSeaCulIEV1 | QSeaDepIEV2 $arg_name,
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface {
        $this->checkPrivate($request, is_sea_cul_api_pr($path));
        [$res, $emp] = $this->q_chan->getStrDes($args[$arg_name->value]);
        return $this->parseJson($request, $response, $res, $emp);
    }

    /** @param array<string> $args */
    public function getBrc(
        QSeaCulIEV1 | QSeaDepIEV2 $path,
        QSeaCulIEV1 | QSeaDepIEV2 $arg_name,
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface {
        $this->checkPrivate($request, is_sea_cul_api_pr($path));
        [$res, $emp] = $this->q_chan->getBrc($args[$arg_name->value]);
        return $this->parseJson($request, $response, $res, $emp);
    }

    /** @param array<string> $args */
    public function getTaxName(
        QSeaCulIEV1 | QSeaDepIEV2 $path,
        QSeaCulIEV1 | QSeaDepIEV2 $arg_name,
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface {
        $this->checkPrivate($request, is_sea_cul_api_pr($path));
        [$res, $emp] = $this->q_chan->getTaxName($args[$arg_name->value]);
        return $this->parseJson($request, $response, $res, $emp);
    }

    /** @param array<string> $args */
    public function getStrNo(
        QSeaCulIEV1 | QSeaDepIEV2 $path,
        QSeaCulIEV1 | QSeaDepIEV2 $arg_name,
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface {
        $this->checkPrivate($request, is_sea_cul_api_pr($path));
        [$res, $emp] = $this->q_chan->getStrNo($args[$arg_name->value]);
        return $this->parseJson($request, $response, $res, $emp);
    }
}
