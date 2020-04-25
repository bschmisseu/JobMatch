<?php

/**
 * Bryce Schmisseur and Hermes Mimini
 * Job Match Application 3.0
 * MyLogger.php 2.0
 * April 5 2020
 *
 * Implementation of the logger service
 */

namespace App\services\utility;

use Illuminate\Support\Facades\Log;

class MyLogger implements LoggerInterface
{
    /**
     * 
     * {@inheritDoc}
     * @see \App\services\utility\LoggerInterface::debug()
     */
    public function debug($message, $data=array())
    {
        Log::debug($message . (count($data) != 0 ? 'with data of ' . print_r($data, true) : ""));
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \App\services\utility\LoggerInterface::warning()
     */
    public function warning($message, $data=array())
    {
        Log::warning($message . (count($data) != 0 ? 'with data of ' . print_r($data, true) : ""));
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \App\services\utility\LoggerInterface::error()
     */
    public function error($message, $data=array())
    {
        Log::error($message . (count($data) != 0 ? 'with data of ' . print_r($data, true) : ""));
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \App\services\utility\LoggerInterface::info()
     */
    public function info($message, $data=array())
    {
        Log::info($message . (count($data) != 0 ? 'with data of ' . print_r($data, true) : ""));
    }  
}

