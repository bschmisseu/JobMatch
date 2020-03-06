<?php

/**
 * Bryce Schmisseur and Hermes Mimini
 * Job Match Application 3.0
 * DatabaseException.php  1.0
 * Febuary 23 2020
 *
 * Custom Exception to be thrown in case of a SQL Exception
 */

namespace App\data;

Class DatabaseException extends \Exception {
    
    /**
     * Constuctor for the exception
     * @param $message - string: the stack track of the exception
     * @param $code - integer: the number type of the exception
     * @param $exception - Exception: the original exception that had been thrown
     */
    public function DatabaseException($message, $code = 0, \Exception $exception = null)
    {
        parent::__construct($message, $code, $exception);
    }
}