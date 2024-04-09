<?php

namespace Application\Controllers;

use Peroxide\DependencyInjection\Container;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;

class HealthCheckController
{
    public function __construct(
        protected readonly Container $container
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
