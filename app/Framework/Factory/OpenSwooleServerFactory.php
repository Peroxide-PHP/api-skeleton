<?php

namespace Application\Framework\Factory;

use OpenSwoole\Http\Server;

class OpenSwooleServerFactory
{
    public function __invoke(): Server
    {
        $server = new Server('0.0.0.0', 80);

        $server->set([
            'worker_num' => 4,      // The number of worker processes to start
            'task_worker_num' => 4  // The amount of task workers to start
        ]);

        return $server;
    }
}
