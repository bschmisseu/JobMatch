<?php

/**
 * Bryce Schmisseur and Hermes Mimini
 * Job Match Application 3.0
 * LoginRegistrationController.php  2.0
 * Febuary 23 2020
 *
 * User Busienss Service is to connect the controller method to the data service methods
 */

namespace App\business;

use App\data\UserDataService;
use App\data\EducationDataService;
use App\data\JobDataService;

class UserBusinessService implements BusinessServiceInterface{
    
    private $dataService;
    private $educationService;
    private $jobService;
    
    /**
     *
     * {@inheritDoc}
     * @see \App\business\BusinessServiceInterface::__construct()
     */
    public function __construct()
    {
        $this->dataService = new UserDataService();
        $this->educationService = new EducationDataService();
        $this->jobService = new JobDataService(); 
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \App\business\BusinessServiceInterface::authenticate()
     */
    public function authenticate($object)
    {
        //Gets an array of users from the data service
        $returnNum = $this->findBy($object);
        
        if($returnNum > 1)
        {
            return $returnNum;
        }
        
        else
        {
            return null;
        }
    }

    /**
     * 
     * {@inheritDoc}
     * @see \App\business\BusinessServiceInterface::viewById()
     */
    public function viewById(int $id)
    {
        //returns a user model from the database
        return $this->dataService->viewById($id);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \App\business\BusinessServiceInterface::create()
     */
    public function create($object)
    {
        //Sends a object to to the data service in write to the database
        return $this->dataService->create($object);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \App\business\BusinessServiceInterface::update()
     */
    public function update($object)
    {
        //Sends an updated object to the data service
        return $this->dataService->update($object);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \App\business\BusinessServiceInterface::delete()
     */
    public function delete(int $id)
    {
        //Sends an id of an object to be deleted
        return $this->dataService->delete($id);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \App\business\BusinessServiceInterface::viewAll()
     */
    public function viewAll()
    {
        //Request an array of all user objects from the data service
        return $this->dataService->viewAll();
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \App\business\BusinessServiceInterface::viewByParentId()
     */
    public function viewByParentId(int $parentId)
    {
        return $this->dataService->viewByParent($parentId);
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \App\business\BusinessServiceInterface::findBy()
     */
    public function findBy($object)
    {
        return $this->dataService->findBy($object);
    }  
}