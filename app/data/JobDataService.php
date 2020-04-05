<?php

/**
 * Bryce Schmisseur and Hermes Mimini
 * Job Match Application 3.0
 * JobDataService.php  2.0
 * Febuary 23 2020
 *
 * DataService in order to implement CRUD operations to the database
 */

namespace App\data;

use App\model\Job;
use Illuminate\Support\Facades\Log;
use Exception;

Class JobDataService implements DataServiceInterface
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
        Log::info("Entering JobDataService.findById(Int)");
        
        try
        {
            //Stores all the SQL commands used to gather all the inforamtion of the jobs
            $sql_query_jobs = "SELECT * FROM JOB WHERE ID = {$id}";
            
            //Runs all the querys to the database
            $results_job = mysqli_query($this->connection, $sql_query_jobs);
             
            $rowJobs = $results_job->fetch_assoc();
            
            //Creates vaibles from the data of the database
            $jobId = $rowJobs['ID'];
            $jobTitle = $rowJobs['JOB_TITLE'];
            $company = $rowJobs['JOB_COMPANY'];
            $startDate = $rowJobs['START_DATE'];
            $endDate = $rowJobs['END_DATE'];
            $jobDescription = $rowJobs['DESCRIPTION'];
            $userId = $rowJobs['USER_ID'];
            
            //Creates a Job object and stores it into the array of jobs
            $currentJob = new Job($jobId, $jobTitle, $company, $startDate, $endDate, $jobDescription, $userId); 
            
            Log::info("Exiting JobDataService.findById(Int)");
            return $currentJob;
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
        Log::info("Entering JobDataService.create(Job)");
        
        try
        {
            $sqlStatement = "INSERT INTO `JOB` (`ID`, `JOB_TITLE`, `JOB_COMPANY`, `START_DATE`, `END_DATE`, `DESCRIPTION`, `USER_ID`) VALUES (NULL, '{$object->getTitle()}', '{$object->getCompanyName()}', '{$object->getStartingDate()}', '{$object->getEndingDate()}', '{$object->getDescription()} ', '{$object->getUserId()}');";
            
            //Runs the query in the database
            $result = $this->connection->query($sqlStatement);
            
            //Returns the number of rows affected
            Log::info("Exiting JobDataService.create(Job)");
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
        Log::info("Entering JobDataService.update(Job)");
        
        try 
        { 
            $sqlJob = "UPDATE `JOB` SET `JOB_TITLE` = '{$object->getTitle()}',
                          `JOB_COMPANY` = '{$object->getCompanyName()}', `START_DATE` = '{$object->getStartingDate()}',
                          `END_DATE` = '{$object->getEndingDate()}', `DESCRIPTION` = '{$object->getDescription()}' WHERE
                          `JOB`.`ID` = {$object->getId()};";
            
            $this->connection->query($sqlJob);
            
            Log::info("Exiting JobDataService.update(Job)");
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
        Log::info("Entering JobDataService.delete(Job)");
        
        try
        {
            $sqlEducation = "DELETE FROM `JOB` WHERE `ID`= {$object->getId()};";
            
            $this->connection->query($sqlEducation);
            
            Log::info("Exiting JobDataService.delete(Job)");
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
        Log::info("Entering JobDataService.viewAll()");
        
        try 
        {
            //creates an array to store the objects
            $objects = array();
            $indexJob = 0;
            
            //SQL statment that is run to return all the rows of the job obejcts in the database
            $sqlQuery = "SELECT * FROM JOB";
            $resutls = mysqli_query($this->connection, $sqlQuery);
            
            //While loop to iterate through all the rows that were returned
            while($row = $resutls->fetch_assoc())
            {
                //Gets the users id of current user
                $id = $row['ID'];
                
                //Intialized a varible with the users object
                $currentJob = $this->findById($id);
                
                //Adds the education models to the array
                $objects[$indexJob] = $currentJob;
                $indexJob++;
            }
            
            //returns the array of objects
            Log::info("Exiting JobDataService.viewAll()");
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
        Log::info("Entering JobDataService.findByParent(Int)");
        
        try
        {
            //creates an array to store the objects
            $objects = array();
            $indexJob = 0;
            
            //SQL statment that is run to return all the rows of the job obejcts in the database based on the user
            $sqlQuery = "SELECT * FROM JOB WHERE USER_ID = $parentId";
            $resutls = mysqli_query($this->connection, $sqlQuery);
            
            //While loop to iterate through all the rows that were returned
            while($row = $resutls->fetch_assoc())
            {
                //Gets the users id of current user
                $id = $row['ID'];
                
                //Intialized a varible with the users object
                $currentJob = $this->findById($id);
                
                //Adds the education models to the array
                $objects[$indexJob] = $currentJob;
                $indexJob++;
            }
            
            //returns the array of objects
            Log::info("Exiting JobDataService.findByParent(Int)");
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