<?php

namespace Application\Framework\Decorators;

use Slim\App;

class GlobalCors
{
    public function __construct(
        protected readonly App $app
    ) {
    }

    public function getDecorated(
        string $allowOrigin = '*',
        string $headers = null,
        string $methods = null
    ): App {
        $this->app->options('/{routes:.+}', function ($request, $response) {
            return $response;
        });

        $this->app->add(
            fn ($request, $handler) => $handler->handle($request)
                ->withHeader('Access-Control-Allow-Origin', $allowOrigin)
                ->withHeader(
                    'Access-Control-Allow-Headers',
                    $headers ?? 'X-Requested-With, Content-Type, Accept, Origin, Authorization'
                )
                ->withHeader('Access-Control-Allow-Methods', $methods ?? 'GET, POST, PUT, DELETE, PATCH, OPTIONS')
        );
        return $this->app;
    }
}
