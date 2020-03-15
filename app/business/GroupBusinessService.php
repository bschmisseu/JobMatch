<?php

/**
 * Bryce Schmisseur and Hermes Mimini
 * Job Match Application 3.0
 * GroupBusinessService.php  3.0
 * March 8 2020
 *
 * Business Service used to connect the contonller method with the data service for CRUD operations 
 */

namespace App\business;

use App\data\GroupDataService;
use App\data\UserDataService;

Class GroupBusinessService implements BusinessServiceInterface
{
    private $dataService;
    private $userService; 
    
    /**
     * Defualt Constructor
     */
    public function __construct()
    {
        $this->dataService = new GroupDataService();
        $this->userService = new UserDataService();
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \App\business\BusinessServiceInterface::authenticate()
     */
    public function authenticate($object)
    {}

    /**
     * 
     * {@inheritDoc}
     * @see \App\business\BusinessServiceInterface::viewById()
     */
    public function findById(int $id)
    {
        return $this->dataService->findById($id);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \App\business\BusinessServiceInterface::create()
     */
    public function create($object)
    {
       return $this->dataService->create($object); 
    }

    /**
     * 
     * {@inheritDoc}
     * @see \App\business\BusinessServiceInterface::update()
     */
    public function update($object)
    {
        return $this->dataService->update($object);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \App\business\BusinessServiceInterface::viewByParentId()
     */
    public function findByParent(int $parentId)
    {
        return $this->dataService->findByParent($parentId);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \App\business\BusinessServiceInterface::delete()
     */
    public function delete($object)
    {
        return $this->dataService->delete($object);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \App\business\BusinessServiceInterface::viewAll()
     */
    public function viewAll()
    {
        $groups = $this->dataService->viewAll();

        for($i = 0; $i < count($groups); $i++)
        {
            $currentId = $groups[$i]->getUserId();

            $currentUser = $this->userService->findById($currentId);

            $groups[$i]->setOwnerName($currentUser->getUserCredential()->getUserName());
        }
        
        return $groups;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \App\business\BusinessServiceInterface::findByObject()
     */
    public function findByObject($object)
    {
        return $this->dataService->findByObject($object);
    }

}