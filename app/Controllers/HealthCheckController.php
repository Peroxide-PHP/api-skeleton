<?php

namespace Application\Controllers;

use Application\Framework\Factory\OpenSwooleResponseFactory;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class HealthCheckController
{
    public function __construct(
        protected readonly ContainerInterface $container
    ) {
    }

    public function __invoke(): ResponseInterface
    {
        /**
         * @var ResponseFactoryInterface $responseFactory
         */
        $responseFactory = $this->container->get(ResponseFactoryInterface::class);
        $response = $responseFactory->createResponse();

        $response->getBody()->write('Health checked!');

        return $response;
    }
}
