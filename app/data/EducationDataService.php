<?php

/**
 * Bryce Schmisseur and Hermes Mimini
 * Job Match Application 3.0
 * EducationDataService.php  2.0
 * Febuary 23 2020
 *
 * DataService in order to implement CRUD operations to the database
 */

namespace App\data;

use App\model\Education;
use Illuminate\Support\Facades\Log;
use Exception;

Class EducationDataService implements DataServiceInterface
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
        Log::info("Entering EducationDataService.findById(Int)");
        
        try
        {
            //Stores all the SQL commands used to gather all the inforamtion of the eudcation object
            $sql_query_education = "SELECT * FROM EDUCATION WHERE ID = {$id}";
            
            
            //Runs all the querys to the database
            $resutls_education = mysqli_query($this->connection, $sql_query_education);
            
            $rowEducation = $resutls_education->fetch_assoc();
            
            //Creates vaibles from the data of the database
            $educationId = $rowEducation['ID'];
            $schoolName = $rowEducation['NAME'];
            $degree = $rowEducation['DEGREE'];
            $field = $rowEducation['FIELD'];
            $educationStartDate = $rowEducation['START_DATE'];
            $educationEndDate = $rowEducation['END_DATE'];
            $educationDescription = $rowEducation['DESCRIPTION'];
            $userId = $rowEducation['USER_ID'];
            
            //Creates a education object and stores it to the array of education history
            $currentEducation = new Education($educationId, $schoolName, $degree, $field, $educationStartDate,
                                              $educationEndDate, $educationDescription, $userId);
            
            Log::info("Exiting EducationDataService.findById(Int)");
            return $currentEducation;
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
        Log::info("Entering EducationDataService.create(Education)");
        
        try
        {
            //Parameterised SQL to insert education in to the database
            $sqlStatement = "INSERT INTO `EDUCATION` (`ID`, `NAME`, `DEGREE`, `FIELD`, `START_DATE`, `END_DATE`, `DESCRIPTION`, `USER_ID`) 
                            VALUES (NULL, '{$object->getName()}', '{$object->getDegree()}', '{$object->getField()}', '{$object->getStartDate()}', 
                            '{$object->getEndDate()}', '{$object->getDescription()}', '{$object->getUserId()}');";
        
            //Runs the query in the database
            $result = $this->connection->query($sqlStatement);
            
            //Returns the number of rows affected
            Log::info("Exiting EducationDataService.create(Education)");
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
        Log::info("Entering EducationDataService.update(Education)");
        
        try 
        { 
            //Parameterised SQL to update an education in to the database
            $sqlEducation = "UPDATE `EDUCATION` SET `NAME` = '{$object->getName()}', `DEGREE` = '{$object->getDegree()}',
                                `FIELD` = '{$object->getField()}', `START_DATE` = '{$object->getStartDate()}',
                                `END_DATE` = '{$object->getEndDate()}', `DESCRIPTION` = '{$object->getDescription()}'
                                 WHERE `EDUCATION`.`ID` = {$object->getId()};";
            
            //Runs the UPDATE within the databse
            $this->connection->query($sqlEducation);
            
            //Returns the number of rows affected
            Log::info("Exiting EducationDataService.update(Education)");
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
        Log::info("Entering EducationDataService.delete(Int)");
        
        try
        {
            //Parameterised SQL to delete an education from the database
            $sqlEducation = "DELETE FROM `EDUCATION` WHERE `ID`= {$object->getId()};";
            
            //Runs the DELETE within the databse
            $this->connection->query($sqlEducation);
            
            //Returns the number of rows affected
            Log::info("Exiting EducationDataService.delete(Int)");
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
        Log::info("Entering EducationDataService.viewAll()");
        
        try
        {
            //creates an array to store the objects
            $objects = array();
            $indexEducation = 0;
            
            //SQL statment that is run to return all the rows of the eduaction obejcts in the database
            $sqlQuery = "SELECT * FROM EDUCATION";
            $resutls = mysqli_query($this->connection, $sqlQuery);
            
            //While loop to iterate through all the rows that were returned
            while($row = $resutls->fetch_assoc())
            {
                //Gets the educations id of current object
                $id = $row['ID'];
                
                //Intialized a varible with the education object
                $currentEducation = $this->findById($id);
                
                //Adds the education models to the array
                $objects[$indexEducation] = $currentEducation;
                $indexEducation++;
            }
            
            //returns the array of objects
            Log::info("Exiting EducationDataService.viewAll()");
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
        Log::info("Entering EducationDataService.findByParent(Int)");
        
        try
        {
            //creates an array to store the objects
            $objects = array();
            $indexEducation = 0;
            
            //SQL statment that is run to return all the rows of the eduaction obejcts in the database based on the user
            $sqlQuery = "SELECT * FROM EDUCATION WHERE USER_ID = $parentId";
            $resutls = mysqli_query($this->connection, $sqlQuery);
            
            //While loop to iterate through all the rows that were returned
            while($row = $resutls->fetch_assoc())
            {
                //Gets the education id of current education
                $id = $row['ID'];
                
                //Intialized a varible with the users object
                $currentEducation = $this->findById($id);
                
                //Adds the education models to the array
                $objects[$indexEducation] = $currentEducation;
                $indexEducation++;
            }
            
            //returns the array of objects
            Log::info("Exiting EducationDataService.findByParent(Int)");
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