<?php

/**
 * Bryce Schmisseur and Hermes Mimini
 * Job Match Application 3.0
 * LoginRegistrationController.php  2.0
 * Febuary 23 2020
 *
 * DataServiceInterface is used as a stucture for any of the data services to inherit
 */

namespace App\data;

interface DataServiceInterface{
    
    function __construct();
    
    /**
     * Create Object takes in an object that is then sent to the data service
     * @param $object - generic: an object Model
     */
    public function create($object);
    
    /**
     * Update user takes in an object that is then passed through to the data service to be updated within the database
     * @param $object - generic: an object Model
     */
    public function update($object);
    
    /**
     * Delete user takes in an integer of an id of a user to be delete within the database
     * @param $object - generic: an object Model
     */
    public function delete($object);
    
    /**
     * View all returns a list of all object models from the database
     */
    public function viewAll();
    
    /**
     * ViewById takes in an id that will then return the full model of the object
     * @param $id int: id number of the object within the database
     */
    public function findById(int $id);
    
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