<?php

/**
 * Bryce Schmisseur and Hermes Mimini
 * Job Match Application 3.0
 * GroupDataService.php  1.0
 * March 8 2020
 *
 * DataService in order to implement CRUD operations to the database
 */

namespace App\data;

use Illuminate\Support\Facades\Log;
use Exception;
use App\model\Groups;

Class GroupDataService implements DataServiceInterface
{
    /**
     * Defualt Constuctor inorder to initialze the connection varible to the database
     */
    public function __construct()
    {
        $database = new Database();
        $this->connection = $database->getConnection();
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \App\data\DataServiceInterface::findById()
     */
    public function findById(int $id)
    {
        try 
        {
            //Stores all the SQL commands used to gather all the inforamtion of the skills
            $sql_query_group = "SELECT * FROM GROUPS WHERE ID = {$id}";
            
            //Runs all the querys to the database
            $results_group = mysqli_query($this->connection, $sql_query_group);
            
            $rowGroup = $results_group->fetch_assoc();
            
            //Creates vaibles from the data of the database
            $skillId = $rowGroup['ID'];
            $name = $rowGroup['NAME'];
            $userId = $rowGroup['USER_ID'];
            
            $index = 0;
            $users = array();
            
            $sql_query = "SELECT * FROM USER_has_GROUPS WHERE GROUPS_ID = {$id}";
            $results = mysqli_query($this->connection, $sql_query);
            
            while($row = $results->fetch_assoc())
            {
                $users[$index] = $row['USER_ID'];
                $index++;
            }
            
            //Creates a Job object and stores it into the array of jobs
            $currentGroup = new Groups($skillId, $name, $userId, $users);
            
            return $currentGroup;
        }
        
        catch(Exception $e)
        {
            //Logs the exception and throws the custom exception
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }

    /**
     * 
     * {@inheritDoc}
     * @see \App\data\DataServiceInterface::create()
     */
    public function create($object)
    {
        try 
        {
            $sqlStatement = "INSERT INTO `GROUPS` (`ID`, `NAME`, `USER_ID`) VALUES (NULL, 
                             '{$object->getName()}', '{$object->getUserId()}');";
            
            //Runs the query in the database
            $result = $this->connection->query($sqlStatement);
            
            //Returns the number of rows affected
            return $result;
        }
        
        catch(Exception $e)
        {
            //Logs the exception and throws the custom exception
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }

    /**
     * 
     * {@inheritDoc}
     * @see \App\data\DataServiceInterface::update()
     */
    public function update($object)
    {   
        try
        {
            $sqlGroups = "UPDATE `GROUPS` SET `NAME` = '{$object->getName()}' WHERE `GROUPS`.`ID` = {$object->getId()};";
            
            $this->connection->query($sqlGroups);
            
            return $this->connection->affected_rows;
        }
        
        catch(Exception $e)
        {
            //Logs the exception and throws the custom exception
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }

    /**
     * 
     * {@inheritDoc}
     * @see \App\data\DataServiceInterface::delete()
     */
    public function delete($object)
    {
        try
        {
            $sqlGroups = "DELETE FROM `GROUPS` WHERE `ID`= {$object->getId()};";
            
            $this->connection->query($sqlGroups);
            
            return $this->connection->affected_rows;
        }
        
        catch(Exception $e)
        {
            //Logs the exception and throws the custom exception
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }

    /**
     * 
     * {@inheritDoc}
     * @see \App\data\DataServiceInterface::viewAll()
     */
    public function viewAll()
    {
        try 
        {
            //creates an array to store the objects
            $objects = array();
            $indexGroups = 0;
            
            //SQL statment that is run to return all the rows of the job obejcts in the database
            $sqlQuery = "SELECT * FROM GROUPS";
            $resutls = mysqli_query($this->connection, $sqlQuery);
            
            //While loop to iterate through all the rows that were returned
            while($row = $resutls->fetch_assoc())
            {
                //Gets the users id of current user
                $id = $row['ID'];
                
                //Intialized a varible with the users object
                $currentGroups = $this->findById($id);
                
                //Adds the education models to the array
                $objects[$indexGroups] = $currentGroups;
                $indexGroups++;
            }
            
            //returns the array of objects
            return $objects;
        }
        
        catch(Exception $e)
        {
            //Logs the exception and throws the custom exception
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }

    /**
     * 
     * {@inheritDoc}
     * @see \App\data\DataServiceInterface::viewByParent()
     */
    public function findByParent(int $parentId)
    {
        try 
        {
            //creates an array to store the objects
            $objects = array();
            $indexGroups = 0;
            
            //SQL statment that is run to return all the rows of the job obejcts in the database
            $sqlQuery = "SELECT * FROM GROUPS WHERE USER_ID = {$parentId}";
            $resutls = mysqli_query($this->connection, $sqlQuery);
            
            //While loop to iterate through all the rows that were returned
            while($row = $resutls->fetch_assoc())
            {
                //Gets the users id of current user
                $id = $row['ID'];
                
                //Intialized a varible with the users object
                $currentGroup = $this->findById($id);
                
                //Adds the education models to the array
                $objects[$indexGroups] = $currentGroup;
                $indexGroups++;
            }
            
            //returns the array of objects
            return $objects;
        }
        
        catch(Exception $e)
        {
            //Logs the exception and throws the custom exception
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \App\data\DataServiceInterface::findBy()
     */
    public function findByObject($object)
    {}
}