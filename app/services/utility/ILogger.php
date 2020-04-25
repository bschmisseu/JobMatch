<?php

/**
 * Bryce Schmisseur and Hermes Mimini
 * Job Match Application 3.0
 * ILogger.php 2.0
 * April 5 2020
 *
 * Interface to setup classes for any logging services that is implemented in to the appliction
 */

namespace App\services\utility;

interface ILogger
{
    /**
     * Getter method for the logger property
     */
    public static function getLogger();
    
    /**
     * Log information with a level of debug
     * @param $message string - message for the logging statment
     * @param $data array - an array of data for the logging statement
     */
    public static function debug($message, $data);
    
    /**
     * Log information with a level of info
     * @param $message string - message for the logging statment
     * @param $data array - an array of data for the logging statement
     */
    public static function info($message, $data);
    
    /**
     * Log information with a level of warning
     * @param $message string - message for the logging statment
     * @param $data array - an array of data for the logging statement
     */
    public static function warning($message, $data);
    
    /**
     * Log information with a level of error
     * @param $message string - message for the logging statment
     * @param $data array - an array of data for the logging statement
     */
    public static function error($message, $data);
}