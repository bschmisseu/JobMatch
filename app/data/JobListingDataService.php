<?php

/**
 * Bryce Schmisseur and Hermes Mimini
 * Job Match Application 3.0
 * JobListingDataService.php  1.0
 * Febuary 23 2020
 *
 * DataService in order to implement CRUD operations to the database
 */

namespace App\data;

use App\model\JobListing;
use Illuminate\Support\Facades\Log;
use Exception;

Class JobListingDataService implements DataServiceInterface
{
    private $connection;
    
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
     * @see \App\data\DataServiceInterface::viewById()
     */
    public function viewById(int $id)
    {
        try
        {
            //Stores all the SQL commands used to gather all the inforamtion of the job listing
            $sql_query_job_listing = "SELECT * FROM JOB_LISTING WHERE ID = {$id}";
            
            //Runs all the querys to the database
            $results_job_listing = mysqli_query($this->connection, $sql_query_job_listing);
            
            $rowJob = $results_job_listing->fetch_assoc();
            
            //Creates vaibles from the data of the database
            $jobListingId = $rowJob['ID'];
            $companyName = $rowJob['COMPANY_NAME'];
            $position = $rowJob['POSITION'];
            $salary = $rowJob['SALARY'];
            $skills = $rowJob['SKILLS'];
            $description = $rowJob['DESCRIPTION'];
    
            //Creates a Job object and stores it into the array of jobs
            $currentJobListing = new JobListing($jobListingId, $companyName, $position, $salary, $skills, $description);
            
            return $currentJobListing;
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
            $sqlStatement = "INSERT INTO `JOB_LISTING` (`ID`, `COMPANY_NAME`, `POSITION`, `SALARY`, `SKILLS`, `DESCRIPTION`) 
                             VALUES (NULL, '{$object->getCompanyName()}', '{$object->getPosition()}', '{$object->getSalary()}', 
                             '{$object->getSkills()}', '{$object->getDescription()}');";
            
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
            $sqlJobListing = "UPDATE `JOB_LISTING` SET `COMPANY_NAME` = '{$object->getCompanyName()}', `POSITION` = '{$object->getPosition()}', 
                        `SALARY` = '{$object->getSalary()}', `SKILLS` = '{$object->getSkills()}', `DESCRIPTION` = '{$object->getDescription()}' 
                         WHERE `JOB_LISTING`.`ID` = {$object->getId()};";
            
            $this->connection->query($sqlJobListing);
            
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
    public function findBy($object)
    {}

    /**
     * 
     * {@inheritDoc}
     * @see \App\data\DataServiceInterface::delete()
     */
    public function delete(int $id)
    {
        try 
        {
            $sqlSkill = "DELETE FROM `JOB_LISTING` WHERE `ID`= {$id};";
            
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
            $indexJobListing = 0;
            
            //SQL statment that is run to return all the rows of the job obejcts in the database
            $sqlQuery = "SELECT * FROM JOB_LISTING";
            $resutls = mysqli_query($this->connection, $sqlQuery);
            
            //While loop to iterate through all the rows that were returned
            while($row = $resutls->fetch_assoc())
            {
                //Gets the users id of current user
                $id = $row['ID'];
                
                //Intialized a varible with the users object
                $currentJobListing = $this->viewByID($id);
                
                //Adds the education models to the array
                $objects[$indexJobListing] = $currentJobListing;
                $indexJobListing++;
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
    public function viewByParent(int $parentId)
    {}   
}