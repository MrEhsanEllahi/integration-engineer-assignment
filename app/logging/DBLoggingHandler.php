<?php

namespace App\Logging;

use App\Models\RuntimeLog;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;

class DBLoggingHandler extends AbstractProcessingHandler
{

    public function __construct($level = Logger::DEBUG, $bubble = true)
    {
        parent::__construct($level, $bubble);
    }

    protected function write(array $record): void
    {
        RuntimeLog::create([
            'title' => $record['message'],
            'level' => $record['level_name'],
            'reference' => !empty($record['context']) && !empty($record['context']['reference']) ? $record['context']['reference'] : 'Laravel',
            'trace' => !empty($record['context']) && !empty($record['context']['trace']) ? $record['context']['trace'] : $record['formatted'],
            'payload' => !empty($record['context']) && !empty($record['context']['payload']) ? $record['context']['payload'] : null,
        ]);
    }

}
