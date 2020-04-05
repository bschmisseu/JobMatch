<?php

/**
 * Bryce Schmisseur and Hermes Mimini
 * Job Match Application 3.0
 * GroupMemberDataService.php  1.0
 * March 15 2020
 *
 * DataService in order to implement CRUD operations to the database
 */

namespace App\data;

use Illuminate\Support\Facades\Log;
use Exception;

Class GroupMemberDataService implements DataServiceInterface
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
    {}

    /**
     * 
     * {@inheritDoc}
     * @see \App\data\DataServiceInterface::create()
     */
    public function create($object)
    {
        Log::info("Entering GroupMemberDataService.create(GroupMember)");
        
        try
        {
            //SQL statment to add a user to a group
            $sqlStatement = "INSERT INTO `USER_has_GROUPS` (`USER_ID`, `GROUPS_ID`) VALUES ('{$object->getUserId()}', '{$object->getGroupId()}');";
            
            //Runs the query in the database
            $result = $this->connection->query($sqlStatement);
            
            //Returns the number of rows affected
            Log::info("Exiting GroupMemberDataService.create(GroupMember)");
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
    {}

    /**
     * 
     * {@inheritDoc}
     * @see \App\data\DataServiceInterface::findByObject()
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
        Log::info("Entering GroupMemberDataService.delete(GroupMember)");
        
        try
        {
            //SQL statment to remove a user from a group
            $sqlGroups = "DELETE FROM `USER_has_GROUPS` WHERE `USER_has_GROUPS`.`USER_ID` = {$object->getUserId()}
                            AND `USER_has_GROUPS`.`GROUPS_ID` = {$object->getGroupId()}";
            
            $this->connection->query($sqlGroups);
            
            Log::info("Exiting GroupMemberDataService.delete(GroupMember)");
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
    {}

    /**
     * 
     * {@inheritDoc}
     * @see \App\data\DataServiceInterface::findByParent()
     */
    public function findByParent(int $parentId)
    {}

    
}