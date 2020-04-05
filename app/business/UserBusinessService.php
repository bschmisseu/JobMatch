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
use App\data\SkillDataService;
use Illuminate\Support\Facades\Log;

class UserBusinessService implements BusinessServiceInterface{
    
    private $dataService;
    private $educationService;
    private $jobService;
    private $skillService;
    
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
        $this->skillService = new SkillDataService();
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \App\business\BusinessServiceInterface::authenticate()
     */
    public function authenticate($object)
    {
        Log::info("Entering UserBusinessService.authenticate(User)");
        //Gets an array of users from the data service
        $returnNum = $this->findByObject($object);
        
        if($returnNum > 1)
        {
            Log::info("Exiting UserBusinessService.authenticate(User)");
            return $returnNum;
        }
        
        else
        {
            Log::info("Exiting UserBusinessService.authenticate(User)");
            return null;
        }
    }

    /**
     * 
     * {@inheritDoc}
     * @see \App\business\BusinessServiceInterface::viewById()
     */
    public function findById(int $id)
    {
        //returns a user model from the database
        Log::info("Entering and Exiting UserBusinessService.findById(Int)");
        return $this->dataService->findById($id);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \App\business\BusinessServiceInterface::create()
     */
    public function create($object)
    {
        //Sends a object to to the data service in write to the database
        Log::info("Entering and Exiting UserBusinessService.create(User)");
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
        Log::info("Entering and Exiting UserBusinessService.update(User)");
        return $this->dataService->update($object);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \App\business\BusinessServiceInterface::delete()
     */
    public function delete($object)
    {
        Log::info("Entering and Exiting UserBusinessService.delete(User)");
        //Sends an id of an object to be deleted
        return $this->dataService->delete($object);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \App\business\BusinessServiceInterface::viewAll()
     */
    public function viewAll()
    {
        Log::info("Entering UserBusinessService.viewAll()");
        //Request an array of all user objects from the data service
        $users = $this->dataService->viewAll();
        
        for($i = 0; $i < count($users); $i++)
        {
            $id = $users[$i]->getIdNum();
            
            $currentUser = $this->dataService->findById($id);
            $currentEducations = $this->educationService->findByParent($id);
            $currentJobs = $this->jobService->findByParent($id);
            $currentSkills = $this->skillService->findByParent($id);
            
            $currentUser->getUserInformation()->setEducationHistory($currentEducations);
            $currentUser->getUserInformation()->setJobs($currentJobs);
            $currentUser->getUserInformation()->setSkills($currentSkills);
            
            $users[$i] = $currentUser;
        }
        
        Log::info("Exiting UserBusinessService.viewAll()");
        return $users;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \App\business\BusinessServiceInterface::viewByParentId()
     */
    public function findByParent(int $parentId)
    {
        Log::info("Entering and Exiting UserBusinessService.findByParent(Int)");
        return $this->dataService->findByParent($parentId);
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \App\business\BusinessServiceInterface::findBy()
     */
    public function findByObject($object)
    {
        Log::info("Entering and Exiting UserBusinessService.findByObject(User)");
        return $this->dataService->findByObject($object);
    }  
}