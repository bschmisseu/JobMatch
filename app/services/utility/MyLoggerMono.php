<?php

/**
 * Bryce Schmisseur and Hermes Mimini
 * Job Match Application 3.0
 * MyLoggerMono.php 2.0
 * April 5 2020
 *
 * Implementation of the logger service
 */

namespace App\services\utility;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\LineFormatter;

Class MyLoggerMono implements ILogger
{
    private static $logger = null;
    
    /**
     *
     * {@inheritDoc}
     * @see \App\services\utility\MyLoggerMono::debug()
     */
    public static function debug($message, $data)
    {
        self::getLogger()->addDebug($message, $data);
    }

    /**
     *
     * {@inheritDoc}
     * @see \App\services\utility\MyLoggerMono::getLogger()
     */
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

    /**
     *
     * {@inheritDoc}
     * @see \App\services\utility\MyLoggerMono::warning()
     */
    public static function warning($message, $data = array())
    {
        self::getLogger()->addWarning($message, $data = array());
    }

    /**
     *
     * {@inheritDoc}
     * @see \App\services\utility\MyLoggerMono::error()
     */
    public static function error($message, $data = array())
    {
        self::getLogger()->addError($message, $data = array());
    }

    /**
     *
     * {@inheritDoc}
     * @see \App\services\utility\MyLoggerMono::info()
     */
    public static function info($message, $data = array())
    {
        self::getLogger()->addInfo($message, $data = array());
    }
 
}