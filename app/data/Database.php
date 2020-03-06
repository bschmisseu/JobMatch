<?php

/**
 * Bryce Schmisseur and Hermes Mimini
 * Job Match Application 3.0
 * Database.php  2.0
 * Febuary 23 2020
 *
 * Houses a method inorder to connect to the database
 */

namespace App\data;

Class Database 
{
    private $servername = "localhost";
    private $username = "root";
    private $password = "root";
    private $database_name = "JobMatch";
    
    /**
     * getConnection uses the private class varibles to connect to the database using mysqli and return the connection object
     * @return $connection - Connection - connection object to the database
     */
    function getConnection()
    {
        // Create connection
        $connection = mysqli_connect($this->servername, $this->username, $this->password, $this->database_name);
        
        // Check connection
        if (!$connection)
        {
            die("Connection failed: " . mysqli_connect_error());
        }
        
        return $connection;
    }
}