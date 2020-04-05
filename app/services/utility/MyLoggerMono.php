<?php

namespace App\services\utility;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\LineFormatter;

Class MyLoggerMono implements ILogger
{
    private static $logger = null;
    
    public static function debug($message, $data)
    {
        self::getLogger()->addDebug($message, $data);
    }

    public static function getLogger()
    {
        if(self::$logger == null)
        {
            self::$logger = new Logger('MyApp');
            $stream = new StreamHandler('storage/logs/myapp.log', Logger::DEBUG);
            $stream->setFormatter(new LineFormatter("%datetime% : %level_name% : %message% : %context%\n", "g:iA n/j/Y"));
            self::$logger->pushHandler($stream);
        }
        
        return self::$logger;
    }

    public static function warning($message, $data = array())
    {
        self::getLogger()->addWarning($message, $data = array());
    }

    public static function error($message, $data = array())
    {
        self::getLogger()->addError($message, $data = array());
    }

    public static function info($message, $data = array())
    {
        self::getLogger()->addInfo($message, $data = array());
    }
 
}