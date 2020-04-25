<?php

/**
 * Bryce Schmisseur and Hermes Mimini
 * Job Match Application 3.0
 * DTO.php 2.0
 * April 5 2020
 *
 * DTO is to surround the response of a rest call to return more information about the successfulness of the call
 */

namespace App\model;

Class DTO implements \JsonSerializable
{
    private $errorCode;
    private $errorMessage;
    private $data;
    
    public function __construct($errorCode, $errorMessage, $data)
    {
        $this->errorCode = $errorCode;
        $this->errorMessage = $errorMessage;
        $this->data = $data; 
    }
    
    public function jsonSerialize() 
    {
        return get_object_vars($this);
    }
}