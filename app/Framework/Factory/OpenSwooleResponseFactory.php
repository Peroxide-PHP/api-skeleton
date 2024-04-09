<?php

namespace Application\Framework\Factory;

use OpenSwoole\Core\Psr\Response;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;

class OpenSwooleResponseFactory implements ResponseFactoryInterface
{
    public function createResponse(int $code = 200, string $reasonPhrase = ''): ResponseInterface
    {
        return new Response('', $code, $reasonPhrase);
    }
}
