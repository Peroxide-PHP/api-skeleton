<?php

declare(strict_types=1);

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\App;

/**
 * IIFE to isolate execution and global variables
 * @var $app App
 */
return (function (App $app) {

    $app->get('/', function (RequestInterface $request, ResponseInterface $response): ResponseInterface {
        $response->getBody()->write('Healthy!');
        return $response->withStatus(200);
    });


    return $app;
})($app);