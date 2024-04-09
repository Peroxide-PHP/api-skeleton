<?php

use Application\Framework\Factory\OpenSwooleResponseFactory;
use Application\Framework\Factory\OpenSwooleServerFactory;
use Psr\Http\Message\ResponseFactoryInterface;

return [
    // Application Framework dependencies
    OpenSwoole\Http\Server::class   => OpenSwooleServerFactory::class,
    ResponseFactoryInterface::class => fn() => new OpenSwooleResponseFactory(),

];