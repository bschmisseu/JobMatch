<?php

/**
 * Bryce Schmisseur and Hermes Mimini
 * Job Match Application 3.0
 * BusinessServiceInterface.php  3.0
 * Febuary 23 2020
 *
 * BusinessServiceInterface acts as a skeloton outline to any of the business services being used
 */

namespace App\business;

interface BusinessServiceInterface
{
    /**
     * Default constuctor
     */
    function __construct();
    
    /**
     * Method that takes in a full model to send to the database in order to save the information
     * @param $object - generic: an object Model
     */
    public function create($object);
    
    /**
     * Method that takes in an updated model to update the correct objects data
     * @param $object - generic: an object Model
     */
    public function update($object);
    
    /**
     * Mehtod that takes in the ID of the object to delete the object from the database
     * @param $id int: id number of the object within the database
     */
    public function delete($object);
    
    /**
     * Method that return the a list of all the objects in the data base
     */
    public function viewAll();
    
    /**
     * Method that takes in an ID of a specific object and returns a full object model
     * @param $id int: id number of the object within the database
     */
    public function findById(int $id);
    
    /**
     * Method that looks through all the objects in the database to determin if the object inputed match 
     * with a object in the database
     * @param $object - generic: an object Model
     */
    public function authenticate($object);
    
    /**
     * A finder function to return an object based on the forgine key connecting them in the database
     * @param $parentId - int: forgine key id of another object connecting in the databse
     * @return $object - generic: an object Model
     */
    public function findByParent(int $parentId);
    
    /**
     * Finder function that takes an object in to find it in the databse based on elements within the database
     * @param $object - generic: an object Model
     * @return $id - int: The primary key of the object if found
     */
    public function findByObject($object);
    
}