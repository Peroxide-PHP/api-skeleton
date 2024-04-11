<?php

declare(strict_types=1);

use Application\Controllers\HealthCheckController;
use Application\Framework\Decorators\GlobalCors;
use Slim\App;
use Slim\Exception\HttpNotFoundException;

/**
 * IIFE to isolate execution and global variables
 * @var $app App
 */
return (function (App $app) {
    // Activate Global CORS
    $app = (new GlobalCors($app))->getDecorated();

    $app->get('/health-check', HealthCheckController::class);

    // Your routes definitions here
    // You can config route in your preferred directory
    // $app = require __DIR__ . '/../app/Products/routes.php';

    /**
     * Catch-all route to serve a 404 Not Found page if none of the routes match
     * NOTE: make sure this route is defined last
     */
    $app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}', function ($request, $response) {
        throw new HttpNotFoundException($request);
    });

    return $app;
})($app);
