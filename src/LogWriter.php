<?php


namespace Ahmedash95\LogWriter;


use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Monolog\Logger;

class LogWriter
{
    /**
     * The Log channels.
     *
     * @var array
     */
    protected $channels = [];

    /**
     * The Log levels.
     *
     * @var array
     */
    protected $levels = [];

    /**
     * The base path of log files
     * @var string
     */
    protected $logPath;

    /**
     * LogWriter constructor.
     * @param $config array
     */
    public function __construct($config) {
        $this->channels = $config['channels'];
        $this->levels = $config['levels'];
        $this->logPath = $config['log_path'];
    }

    /**
     * Write to log based on the given channel and log level set
     *
     * @param type $channel
     * @param type $message
     * @param array $context
     * @throws InvalidArgumentException
     */
    public function writeLog($channel, $level, $message, array $context = [])
    {
        //check channel exist
        if( !in_array($channel, array_keys($this->channels)) ){
            throw new InvalidArgumentException('Invalid channel used.');
        }

        //lazy load logger
        if( !isset($this->channels[$channel]['_instance']) ){
            //create instance
            $this->channels[$channel]['_instance'] = new Logger($channel);
            //add custom handler
            $this->channels[$channel]['_instance']->pushHandler(
                new LogStreamHandler(
                    $channel,
                    $this->logPath .'/'. $this->channels[$channel]['path'],
                    $this->channels[$channel]['level']
                )
            );
        }
        //write out record
        $this->channels[$channel]['_instance']->{$level}($message, $context);
    }

    /**
     * @param $channel
     * @param $message
     * @param array $context
     */
    public function write($channel, $message, array $context = []){
        if(!isset($this->channels[$channel])){
            throw new InvalidArgumentException("Channel [{$channel}] is not defined");
        }
        //get method name for the associated level
        $level = array_flip($this->levels)[$this->channels[$channel]['level']];
        //write to log
        $this->writeLog($channel, $level, $message, $context);
    }

    //alert('event','Message');
    /**
     * @param $func
     * @param $params
     */
    function __call($func, $params){
        return $this->writeLog($params[0], $func, $params[1]);
    }

}