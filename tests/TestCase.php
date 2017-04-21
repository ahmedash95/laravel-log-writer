<?php

namespace Ahmedash95\LogWriter\Test;


use Ahmedash95\LogWriter\LogWriter;
use Ahmedash95\LogWriter\Providers\LogWriterServiceProvider;
use Illuminate\Support\Facades\Log;
use Monolog\Logger;
use Orchestra\Testbench\TestCase as Orchestra;
use Monolog\Handler\StreamHandler;

abstract class TestCase extends Orchestra
{
    protected $logWriter;

    public function setUp()
    {
        $config = $this->getLogWriterConfig();
        $this->logWriter = new LogWriter($config);
        parent::setUp();
    }

    public function getLogWriterConfig(){
        return [
            'log_path' => $this->getTempDir(),

            'channels' => [
                'event' => [
                    'path' => '/logs/event.log',
                    'level' => Logger::INFO
                ],
                'audit' => [
                    'path' => '/logs/audit.log',
                    'level' => Logger::INFO
                ],
            ],
            'levels' => [
                'debug'     => Logger::DEBUG,
                'info'      => Logger::INFO,
                'notice'    => Logger::NOTICE,
                'warning'   => Logger::WARNING,
                'error'     => Logger::ERROR,
                'critical'  => Logger::CRITICAL,
                'alert'     => Logger::ALERT,
                'emergency' => Logger::EMERGENCY,
            ]
        ];
    }

    protected function getPackageProviders($app)
    {
        return [LogWriterServiceProvider::class];
    }
    protected function getTempDir(){
        return __DIR__.'/tmp';
    }

    public function tearDown(){
        array_map('unlink', glob($this->getTempDir()."/logs/*.*"));
        @rmdir($this->getTempDir().'/logs');
    }
}