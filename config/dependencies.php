<?php

use Application\Framework\Factory\OpenSwooleResponseFactory;
use Application\Framework\Factory\OpenSwooleServerFactory;
use Peroxide\DependencyInjection\Invokables\Singleton;
use Psr\Http\Message\ResponseFactoryInterface;

return [
    // Application Framework dependencies
    OpenSwoole\Http\Server::class   => new Singleton(OpenSwooleServerFactory::class),
    ResponseFactoryInterface::class => fn() => new OpenSwooleResponseFactory(),

];
