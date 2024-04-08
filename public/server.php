<?php

require __DIR__ . '/../vendor/autoload.php';

use Application\Framework\StackHandlers\SlimToOpenSwoole;

use OpenSwoole\Core\Psr\Middleware\StackHandler;
use OpenSwoole\Http\Server;

use Peroxide\DependencyInjection\Container;
use Slim\Factory\AppFactory;

$server = new Server('0.0.0.0', 80);

$container = new Container(require __DIR__ . '/../config/dependencies.php');

$app = AppFactory::createFromContainer($container);

$app = require __DIR__ . '/../config/routes.php';

$app->addErrorMiddleware(false, false, false);

$handler = (new StackHandler())
                ->add(new SlimToOpenSwoole($app));

$server->setHandler($handler);

$server->start();
