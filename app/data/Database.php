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
    private $servername = "sulnwdk5uwjw1r2k.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
    private $username = "v4ogsd1bmdo80lv1";
    private $password = "t7ild4b4k2b4irxw";
    private $database_name = "g9ui5u8rlxw02hgx";
    
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
