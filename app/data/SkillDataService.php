<?php

/**
 * Bryce Schmisseur and Hermes Mimini
 * Job Match Application 3.0
 * SkillDataService.php  1.0
 * Febuary 23 2020
 *
 * DataService in order to implement CRUD operations to the database
 */

namespace App\data;

use App\model\Skill;
use Illuminate\Support\Facades\Log;
use Exception;

Class SkillDataService implements DataServiceInterface
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
            $sql_query_skill = "SELECT * FROM SKILLS WHERE ID = {$id}";
            
            //Runs all the querys to the database
            $results_skill = mysqli_query($this->connection, $sql_query_skill);
            
            $rowSkill = $results_skill->fetch_assoc();
            
            //Creates vaibles from the data of the database
            $skillId = $rowSkill['ID'];
            $skillString = $rowSkill['SKILL_STRING'];
            $userId = $rowSkill['USER_ID'];
            
            //Creates a Job object and stores it into the array of jobs
            $currentSkill = new Skill($skillId, $skillString, $userId);
            
            return $currentSkill;
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
            $sqlStatement = "INSERT INTO `SKILLS` (`ID`, `SKILL_STRING`, `USER_ID`) VALUES (NULL, 
                             '{$object->getSkillString()}', '{$object->getUserId()}');";
            
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
            $sqlSkill = "UPDATE `SKILLS` SET `SKILL_STRING` = '{$object->getSkillString()}' WHERE `SKILLS`.`ID` = {$object->getId()};";
            
            $this->connection->query($sqlSkill);
            
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
     * @see \App\data\DataServiceInterface::findBy()
     */
    public function findByObject($object)
    {}

    /**
     * 
     * {@inheritDoc}
     * @see \App\data\DataServiceInterface::delete()
     */
    public function delete($object)
    {
        try
        {
            $sqlSkill = "DELETE FROM `SKILLS` WHERE `ID`= {$object->getId()};";
            
            $this->connection->query($sqlSkill);
            
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
            $indexSkill = 0;
            
            //SQL statment that is run to return all the rows of the job obejcts in the database
            $sqlQuery = "SELECT * FROM SKILLS";
            $resutls = mysqli_query($this->connection, $sqlQuery);
            
            //While loop to iterate through all the rows that were returned
            while($row = $resutls->fetch_assoc())
            {
                //Gets the users id of current user
                $id = $row['ID'];
                
                //Intialized a varible with the users object
                $currentSkill = $this->findById($id);
                
                //Adds the education models to the array
                $objects[$indexSkill] = $currentSkill;
                $indexSkill++;
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
            $indexSkill = 0;
            
            //SQL statment that is run to return all the rows of the job obejcts in the database
            $sqlQuery = "SELECT * FROM SKILLS WHERE USER_ID = {$parentId}";
            $resutls = mysqli_query($this->connection, $sqlQuery);
            
            //While loop to iterate through all the rows that were returned
            while($row = $resutls->fetch_assoc())
            {
                //Gets the users id of current user
                $id = $row['ID'];
                
                //Intialized a varible with the users object
                $currentSkill = $this->findById($id);
                
                //Adds the education models to the array
                $objects[$indexSkill] = $currentSkill;
                $indexSkill++;
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

    
}