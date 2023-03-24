<?php

namespace App\Logging;

use Monolog\Logger;

class DBCustomLogger
{
    /**
     * Create a custom Monolog instance.
     *
     *
     * @param array $config
     * @return Logger
     */
    public function __invoke(array $config)
    {
        $logger = new Logger("DBLoggingHandler");
        return $logger->pushHandler(new DBLoggingHandler());
    }
}
