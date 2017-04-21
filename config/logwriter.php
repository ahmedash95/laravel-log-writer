<?php

use Monolog\Logger;

return [

    /*
     * The base path of log files
     */
    'log_path' => storage_path(),

    /*
     * The Log channels.
     */
    'channels' => [
        'event' => [
            'path'  => 'logs/event.log',
            'level' => Logger::INFO,
        ],
        'audit' => [
            'path'  => 'logs/audit.log',
            'level' => Logger::INFO,
        ],
    ],

    /*
     * The Log levels.
     */
    'levels' => [
        'debug'     => Logger::DEBUG,
        'info'      => Logger::INFO,
        'notice'    => Logger::NOTICE,
        'warning'   => Logger::WARNING,
        'error'     => Logger::ERROR,
        'critical'  => Logger::CRITICAL,
        'alert'     => Logger::ALERT,
        'emergency' => Logger::EMERGENCY,
    ],

];
