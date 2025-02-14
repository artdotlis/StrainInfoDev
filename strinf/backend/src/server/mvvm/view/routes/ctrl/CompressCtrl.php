<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\view\routes\ctrl;

use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

use function Safe\ini_set;
use function Safe\ob_start;
use function Safe\preg_match;
use function straininfo\server\shared\mvvm\view\api\get_short_arg;

final class CompressCtrl
{
    private readonly Psr17Factory $psr17Factory;

    public function __construct()
    {
        $this->psr17Factory = new Psr17Factory();
    }

    public function __invoke(
        ServerRequestInterface $request,
        RequestHandlerInterface $handler
    ): ResponseInterface {
        $response = $handler->handle($request);
        $req_head = $request->getHeaders()['Accept-Encoding'] ?? [];
        $size = $response->getBody()->getSize() ?? 0;
        $response = $this->res2Large($request, $response);
        if ($size >= 1_000) {
            foreach ($req_head as $enc) {
                if (preg_match('/(,|\s|^)gzip(,|\s|$)/', $enc) === 1) {
                    $response = $response->withHeader('Content-Encoding', 'gzip');
                    ini_set('zlib.output_compression_level', '5');
                    ob_start(ob_gzhandler(...));
                    break;
                }
            }
        }
        return $response;
    }

    private function res2Large(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        if (
            $response->getStatusCode() !== 200 || !(array_key_exists(
                get_short_arg(),
                $request->getQueryParams()
            ) && ($response->getBody()->getSize() ?? 0) > 50_000)
        ) {
            return $response;
        }
        $bodyShort = substr((string) $response->getBody(), 0, 1_000) . '...';
        $newResp = $this->psr17Factory->createResponse($response->getStatusCode());
        foreach ($response->getHeaders() as $name => $values) {
            $newResp = $newResp->withHeader((string) $name, $values);
        }
        $newResp = $newResp->withHeader(
            'Content-Type',
            'text/plain'
        );
        $newResp->getBody()->write($bodyShort);
        return $newResp;
    }
}
