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
use Illuminate\Support\Facades\Log;

Class GroupBusinessService implements GroupBusinessInterface
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
    public function viewById(int $id)
    {
        return $this->dataService->viewById($id);
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
    public function viewByParentId(int $parentId)
    {
        return $this->dataService->viewByParent($parentId);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \App\business\BusinessServiceInterface::delete()
     */
    public function delete(int $id)
    {
        return $this->dataService->delete($id);
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

            $currentUser = $this->userService->viewById($currentId);

            $groups[$i]->setOwnerName($currentUser->getUserCredential()->getUserName());
        }
        
        return $groups;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \App\business\GroupBusinessInterface::joinGroup()
     */
    public function joinGroup($objectId, $userId)
    {
        return $this->dataService->joinGroup($objectId, $userId);
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \App\business\GroupBusinessInterface::leaveGroup()
     */
    public function leaveGroup($objectId, $userId)
    {
        return $this->dataService->leaveGroup($objectId, $userId);
    }
}