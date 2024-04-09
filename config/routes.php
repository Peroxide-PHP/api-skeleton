<?php

declare(strict_types=1);

use Application\Controllers\HealthCheckController;
use Application\Framework\Decorators\GlobalCors;

use Slim\App;
use Slim\Routing\RouteCollectorProxy;

/**
 * IIFE to isolate execution and global variables
 * @var $app App
 */
return (function (App $app) {
    // Activate Global CORS
    $app = (new GlobalCors($app))->getDecorated();

    $app->get('/health-check', HealthCheckController::class);

    $app->group('/v1', function (RouteCollectorProxy $group) {

    });

    return $app;
})($app);