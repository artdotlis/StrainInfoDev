<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\view\routes\ctrl\dbs;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;
use straininfo\server\interfaces\mvvm\view\chan\QVIntArc;
use function straininfo\server\shared\mvvm\view\api\is_arc_api_pr;
use straininfo\server\shared\mvvm\view\api\query\service\QArcE;

use straininfo\server\shared\mvvm\view\StatArgs;

final class DBSCtrlArc extends DBSCtrl
{
    private readonly QVIntArc $q_chan;

    /**
     * @param array<string> $cors
     * @param array<string> $private
     */
    public function __construct(
        QVIntArc $q_chan,
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
    public function getArcBySiId(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface {
        $this->checkPrivate($request, is_arc_api_pr(QArcE::ARC));
        [$res, $emp] = $this->q_chan->getArcSiId($args[QArcE::ID_P->value]);
        return $this->parseJson($request, $response, $res, $emp);
    }
}
