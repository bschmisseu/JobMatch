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
use App\data\GroupMemberDataService;
use App\model\GroupMembers;
use Illuminate\Support\Facades\Log;

Class GroupBusinessService implements BusinessServiceInterface
{
    private $dataService;
    private $userService;
    private $memberService;
    
    /**
     * Defualt Constructor
     */
    public function __construct()
    {
        $this->dataService = new GroupDataService();
        $this->userService = new UserDataService();
        $this->memberService = new GroupMemberDataService();
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
        Log::info("Entering and Exiting GroupBusinessService.findById(Int)");
        return $this->dataService->findById($id);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \App\business\BusinessServiceInterface::create()
     */
    public function create($object)
    {
       Log::info("Entering and Exiting GroupBusinessService.create(Group)");
       return $this->dataService->create($object); 
    }

    /**
     * 
     * {@inheritDoc}
     * @see \App\business\BusinessServiceInterface::update()
     */
    public function update($object)
    {
        Log::info("Entering and Exiting GroupBusinessService.update(Group)");
        return $this->dataService->update($object);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \App\business\BusinessServiceInterface::viewByParentId()
     */
    public function findByParent(int $parentId)
    {
        Log::info("Entering and Exiting GroupBusinessService.findByParent(Int)");
        return $this->dataService->findByParent($parentId);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \App\business\BusinessServiceInterface::delete()
     */
    public function delete($object)
    {
        Log::info("Entering GroupBusinessService.delete(Group)");
      
        //Gets all users apart of the group
        $usersArray = $object->getUsers();
        
        //Removes each group member 
        for($i = 0; $i < count($usersArray); $i++)
        {
            $groupMember = new GroupMembers($object->getId(), $usersArray[$i]);
            
            $this->memberService->delete($groupMember);
        }
        
        Log::info("Exiting GroupBusinessService.delete(Group)");
        //Deletes the group
        return $this->dataService->delete($object);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \App\business\BusinessServiceInterface::viewAll()
     */
    public function viewAll()
    {
        Log::info("Entering GroupBusinessService.viewAll()");
        
        //Gets all groups
        $groups = $this->dataService->viewAll();

        //For each group its gets the users attached to the 
        for($i = 0; $i < count($groups); $i++)
        {
            $currentId = $groups[$i]->getUserId();

            $currentUser = $this->userService->findById($currentId);

            $groups[$i]->setOwnerName($currentUser->getUserCredential()->getUserName());
        }
        
        Log::info("Exiting GroupBusinessService.viewAll()");
        return $groups;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \App\business\BusinessServiceInterface::findByObject()
     */
    public function findByObject($object)
    {
        Log::info("Entering and Exiting GroupBusinessService.findByObject(Group)");
        return $this->dataService->findByObject($object);
    }

}