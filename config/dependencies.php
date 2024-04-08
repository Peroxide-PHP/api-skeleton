<?php

use Application\Framework\PSRFactory\OpenSwooleResponseFactory;
use Psr\Http\Message\ResponseFactoryInterface;

return [
    // Application Framework dependencies
    ResponseFactoryInterface::class => fn() => new OpenSwooleResponseFactory()
];