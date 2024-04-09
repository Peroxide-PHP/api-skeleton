<?php

require __DIR__ . '/../vendor/autoload.php';

use Application\Framework\StackHandlers\SlimToOpenSwoole;

use OpenSwoole\Core\Psr\Middleware\StackHandler;
use OpenSwoole\Http\Server;

use Peroxide\DependencyInjection\Container;
use Slim\Factory\AppFactory;

$container = new Container(require __DIR__ . '/../config/dependencies.php');

$app = AppFactory::createFromContainer($container);

$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, false, false);

$app = require __DIR__ . '/../config/routes.php';

$handler = (new StackHandler())
                ->add(new SlimToOpenSwoole($app));

/**
 * @var Server $server
 */
$server = $container->get(Server::class);
$server->setHandler($handler);

$server->start();
