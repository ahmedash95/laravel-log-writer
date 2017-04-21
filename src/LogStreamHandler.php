<?php

namespace Ahmedash95\LogWriter;


use Monolog\Handler\StreamHandler;

class LogStreamHandler extends StreamHandler
{
    /**
     * Channel name
     *
     * @var String
     */
    protected $channel;

    /**
     * @param String $channel Channel name to write
     * @see parent __construct for params
     */
    public function __construct($channel, $stream, $level = Logger::DEBUG, $bubble = true, $filePermission = null, $useLocking = false)
    {
        $this->channel = $channel;

        parent::__construct($stream, $level, $bubble);
    }

    /**
     * When to handle the log record.
     *
     * @param array $record
     * @return type
     */
    public function isHandling(array $record)
    {
        //Handle if Level high enough to be handled (default mechanism)
        //AND CHANNELS MATCHING!
        if( isset($record['channel']) ){
            return (
                $record['level'] >= $this->level &&
                $record['channel'] == $this->channel
            );
        } else {
            return (
                $record['level'] >= $this->level
            );
        }
    }

}