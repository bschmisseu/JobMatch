<?php

/**
 * Bryce Schmisseur and Hermes Mimini
 * Job Match Application 3.0
 * UserDataService.php  3.0
 * Febuary 23 2020
 *
 * DataService in order to implement CRUD operations to the database
 */

namespace App\data;

use App\model\User;
use App\model\UserCredential;
use App\model\UserInformation;
use Illuminate\Support\Facades\Log;
use Exception;

Class UserDataService implements DataServiceInterface {
    
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
     * @see \App\data\DataServiceInterface::findById()
     */
    public function findById(int $id)
    {
        Log::info("Entering UserDataService.findById(Int)");
    
        try
        {
            //Stores all the SQL commands used to gather all the inforamtion of the user
            $sql_query_user = "SELECT * FROM USER WHERE ID = {$id}";
            $sql_query_user_cred = "SELECT * FROM USER_CREDENTIAL WHERE USER_ID = {$id}";
            $sql_query_user_info = "SELECT * FROM USER_INFO WHERE USER_ID = {$id}";
            
            //Runs all the querys to the database
            $results_user = mysqli_query($this->connection, $sql_query_user);
            $results_user_cred = mysqli_query($this->connection, $sql_query_user_cred);
            $results_user_info = mysqli_query($this->connection, $sql_query_user_info);
            
            //Gets the users inforamtion from the queries
            $rowUser = $results_user->fetch_assoc();
            $rowUserCred = $results_user_cred->fetch_assoc();
            $rowUserInfo = $results_user_info->fetch_assoc();
            
            //Creates varibels of all the data from the database
            $firstName = $rowUser['FIRSTNAME'];
            $lastName = $rowUser['LASTNAME'];
            $email = $rowUser['EMAIL'];
            $phoneNumber = $rowUser['PHONENUMBER'];
            $objectRole = $rowUser['USER_ROLE'];
            $active = $rowUser['ACTIVE'];
            $objectName = $rowUserCred['USERNAME'];
            $password = $rowUserCred['PASSWORD'];
            $bio = $rowUserInfo['BIO'];
            $jobs = array();
            $educationHistory = array();
            $skills = array();
            
            //Creates a full user object
            $currentUserCreds = new UserCredential($objectName, $password);
            $currentUserInfo = new UserInformation($bio, $jobs, $educationHistory, $skills);
            $currentUser = new User($id, $firstName, $lastName, $email, $phoneNumber, $objectRole, $active, $currentUserCreds, $currentUserInfo);
            
            //Returns the full user model
            Log::info("Exiting UserDataService.findById(Int)");
            return $currentUser;
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
        Log::info("Entering UserDataService.create(User)");
        
        try 
        {
            //SQL statment to check to see if the user name if already taken
            $sqlCheck = "SELECT * FROM USER_CREDENTIAL WHERE USERNAME = '{$object->getUserCredential()->getUserName()}'";
            $results_check = mysqli_query($this->connection, $sqlCheck);
            $numberOfRows = mysqli_num_rows($results_check);
            
            //A decision to determin if the user name has been taken 
            if($numberOfRows <= 0)
            {
                //If the username has not been taken it will then create a SQL statemnt inorder to store the new users inforamtion
                $sqlStatement = "INSERT INTO `user` (`ID`, `FIRSTNAME`, `LASTNAME`, `EMAIL`, `PHONENUMBER`, `USER_ROLE`, `ACTIVE`) 
                                 VALUES (NULL, '{$object->getFirstName()}', '{$object->getLastName()}', '{$object->getEmail()}', 
                                 '{$object->getPhoneNumber()}', '{$object->getUserRole()}', '{$object->isActive()}');";
                
                //Runs the query in the database
                $result = $this->connection->query($sqlStatement);
                
                //Retrieves the last id number that was stored in the database
                $objectID = mysqli_insert_id($this->connection);
                
                //Completes the user object by setting the id number
                $object->setIdNum($objectID);
                
                //If the prvious SQL Statment falid then it will return back to the business service
                if($result == false)
                {
                    Log::info("Exiting UserDataService.create(User)");
                    return $result;
                }
                
                else
                {
                    //SQL statemnt to create write the inforamtion of the usercredential object
                    $sqlStatementCred = "INSERT INTO `user_credential` (`USERNAME`, `PASSWORD`, `USER_ID`) VALUES 
                                ('{$object->getUserCredential()->getUserName()}', '{$object->getUserCredential()->getPassword()}', 
                                '{$object->getIdNum()}');";
                    
                    //Runs the query in the datbase
                    $result = $this->connection->query($sqlStatementCred);
                    
                    //SQL statemnt to create write the inforamtion of the usercredential object
                    $sqlStatementInfo = "INSERT INTO `USER_INFO` (`BIO`, `USER_ID`) VALUES ('BIO', '{$object->getIdNum()}');";
                    
                    //Runs the query in the datbase
                    $result = $this->connection->query($sqlStatementInfo);
                    
                    Log::info("Exiting UserDataService.create(User)");
                    return $result;
                }
            }
            
            else
            {
                //If the username has already been taken return the error code of 5
                Log::info("Exiting UserDataService.create(User)");
                return 5;
            }
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
        Log::info("Entering UserDataService.update(User)");
        
        try 
        {
            //Varible initialed to keep track of all the rows affected throughout the update proccess 
            $numRowsAffected = 0;
            
            //Creates SQL statments inorder update all the information of the user
            $sqlUser = "UPDATE `USER` SET `FIRSTNAME` = '{$object->getFirstName()}', `LASTNAME` = '{$object->getLastName()}', 
                        `EMAIL` = '{$object->getEmail()}', `PHONENUMBER` = '{$object->getPhoneNumber()}', `USER_ROLE` = 
                        '{$object->getUserRole()}', `ACTIVE` = '{$object->isActive()}' WHERE `USER`.`ID` = {$object->getIdNum()};";
            $sqlUserCreds = "UPDATE `USER_CREDENTIAL` SET `USERNAME` = '{$object->getUserCredential()->getUserName()}', 
                            `PASSWORD` = '{$object->getUserCredential()->getPassword()}' WHERE 
                            `USER_CREDENTIAL`.`USER_ID` = {$object->getIdNum()};";
            $sqlUserInfo = "UPDATE `USER_INFO` SET `BIO` = '{$object->getUserInformation()->getBio()}' WHERE 
                            `USER_INFO`.`USER_ID` = {$object->getIdNum()};";
            
            //Runs all the statments through the database
            $this->connection->query($sqlUser);
            $numRowsAffected += $this->connection->affected_rows;
            $this->connection->query($sqlUserCreds);
            $numRowsAffected += $this->connection->affected_rows;
            $this->connection->query($sqlUserInfo);
            $numRowsAffected += $this->connection->affected_rows;
            
            //Return the number of rows affected by the update
            Log::info("Exiting UserDataService.update(User)");
            return $numRowsAffected;
        }
        
        catch(Exception $e)
        {
            //Logs the exception and throws the custom exception
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }

    public function delete($object)
    {
        Log::info("Entering UserDataService.delete(User)");
        
        try
        {
            //Varible initialed to keep track of all the rows affected throughout the deletion proccess 
            $numRowsAffected = 0;
            
            //Creates SQL Stamtments to delete all traces of the user
            $sqlUser = "DELETE FROM `USER` WHERE `ID`= {$object->getIdNum()};";
            $sqlUserCred = "DELETE FROM `USER_CREDENTIAL` WHERE `USER_ID`= {$object->getIdNum()};";
            $sqlUserInfo = "DELETE FROM `USER_INFO` WHERE `USER_ID`= {$object->getIdNum()};";
            
            //Runs all SQL statements through the database while also incrementing the number of rows affted
            $this->connection->query($sqlUserCred);
            $numRowsAffected += $this->connection->affected_rows;
            
            $this->connection->query($sqlUserInfo);
            $numRowsAffected += $this->connection->affected_rows;
            
            $this->connection->query($sqlUser);
            $numRowsAffected += $this->connection->affected_rows;
            
            //Returns the number of rows affected
            Log::info("Exiting UserDataService.delete(User)");
            return $numRowsAffected;
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
        Log::info("Entering UserDataService.viewAll()");
        
        try
        {
            //creates an array to store the objects
            $objects = array(); 
            $indexUser = 0; 
            
            //SQL statment that is run to return all the rows of users in the database
            $sqlQuery = "SELECT * FROM USER";
            $resutls = mysqli_query($this->connection, $sqlQuery);
            
            //While loop to iterate through all the rows that were returned
            while($row = $resutls->fetch_assoc())
            {
                //Gets the users id of current user
                $id = $row['ID'];
                
                //Intialized a varible with the users object 
                $currentUser = $this->findById($id);
                
                //Adds the users object to the array
                $objects[$indexUser] = $currentUser;
                $indexUser++;
            }
            
            //returns the array of objects 
            Log::info("Exiting UserDataService.viewAll()");
            return $objects;
        }
        
        catch(Exception $e)
        {
            //Logs the exception and throws the custom exception
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
    
    public function findByParent(int $parentId)
    {}
    
    public function findByObject($object)
    {
        Log::info("Entering UserDataService.findByObject(User)");
        
        try 
        {
            //SQL statment that is run to return all the rows of the job obejcts in the database
            $sqlQuery = "SELECT * FROM USER_CREDENTIAL WHERE BINARY USERNAME = '{$object->getUserName()}' AND BINARY PASSWORD = '{$object->getPassword()}'";
            
            $resutls = mysqli_query($this->connection, $sqlQuery);
           
            $numRowsAffected = $this->connection->affected_rows;
            
            if($numRowsAffected > 1)
            {
                Log::info("Exiting UserDataService.findByObject(User)");
                return -2;
            }
            
            else if($numRowsAffected == 1)
            {
                $row = $resutls->fetch_assoc();
                Log::info("Exiting UserDataService.findByObject(User)");
                return $row['USER_ID'];
            }
            
            else 
            {
                Log::info("Exiting UserDataService.findByObject(User)");
                return -1;
            }
        }
        
        catch(Exception $e)
        {
           //Logs the exception and throws the custom exception
           Log::error("Exception: ", array("message" => $e->getMessage()));
           throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
}