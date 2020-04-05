<?php

/**
 * Bryce Schmisseur and Hermes Mimini
 * Job Match Application 3.0
 * SkillBusinessService.php  3.0
 * Febuary 23 2020
 *
 * Business Service used to connect the contonller method with the data service for CRUD operations 
 */

namespace App\business;

use App\data\SkillDataService;
use Illuminate\Support\Facades\Log;

Class SkillBusinessService implements BusinessServiceInterface
{
    private $dataService;
    
    /**
     * Defualt Constructor
     */
    public function __construct()
    {
        $this->dataService = new SkillDataService();
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
        Log::info("Entering and Exiting SkillBusinessService.findById(Int)");
        return $this->dataService->findById($id);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \App\business\BusinessServiceInterface::create()
     */
    public function create($object)
    {
       Log::info("Entering and Exiting SkillBusinessService.create(Skill)");
       return $this->dataService->create($object); 
    }

    /**
     * 
     * {@inheritDoc}
     * @see \App\business\BusinessServiceInterface::update()
     */
    public function update($object)
    {
        Log::info("Entering and Exiting SkillBusinessService.update(Skill)");
        return $this->dataService->update($object);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \App\business\BusinessServiceInterface::findBy()
     */
    public function findByObject($object)
    {
        Log::info("Entering and Exiting SkillBusinessService.findByObject(Skill)");
        return $this->dataService->findByObject($object);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \App\business\BusinessServiceInterface::viewByParentId()
     */
    public function findByParent(int $parentId)
    {
        Log::info("Entering and Exiting SkillBusinessService.findByParent(Int)");
        return $this->dataService->findByParent($parentId);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \App\business\BusinessServiceInterface::delete()
     */
    public function delete($object)
    {
        Log::info("Entering and Exiting SkillBusinessService.delete(Skill)");
        return $this->dataService->delete($object);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \App\business\BusinessServiceInterface::viewAll()
     */
    public function viewAll()
    {
        Log::info("Entering and Exiting SkillBusinessService.viewAll()");
        return $this->dataService->viewAll();
    }
}