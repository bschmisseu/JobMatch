<?php

namespace App\model;

/*
 * Bryce Schmisseur and Hermes Mimini
 * Job Match Application 3.0
 * UserCredential.php 2.0
 * Febuary 23 2020
 *
 * UserCredential model inorder to store the username and password of the user
 */

Class UserCredential implements \JsonSerializable
{
    private $userName;
    private $password;
    
    /**
     * Constructor poulated with all properies inorder when creating the object to set the varibles
     * @param $userName - string: the users username inorder to login
     * @param $password - string: the users password inorder to login
     */
    function __construct(String $userName, String $password)
    {
        $this->userName = $userName;
        $this->password = $password;
    }
    
    /**
     * The getter method for the username property
     * @return $userName - string: the users username inorder to login
     */
    public function getUserName()
    {
        return $this->userName;
    }
    
    /**
     * The getter method for the password property
     * @return $password - string: the users password inorder to login
     */
    public function getPassword()
    {
        return $this->password;
    }
    
    /**
     * The setter method for the username property
     * @param $username - String: the users username inorder to login
     */
    public function setUserName(String $userName)
    {
        $this->userName = $userName;
    }
    
    /**
     * The setter method for the password property
     * @param $password - string: the users password inorder to login
     */
    public function setPassword(String $password)
    {
        $this->password = $password;
    }
    
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

}