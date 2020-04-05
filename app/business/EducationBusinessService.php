<?php

/**
 * Bryce Schmisseur and Hermes Mimini
 * Job Match Application 3.0
 * EducationBusinessService.php  3.0
 * Febuary 23 2020
 *
 * Business Service used to connect the contonller method with the data service for CRUD operations
 */

namespace App\business;

use App\data\EducationDataService;
use Illuminate\Support\Facades\Log;

Class EducationBusinessService implements BusinessServiceInterface
{
    
    private $dataService;
    
    /**
     * Defualt Constuctor
     */
    public function __construct()
    {
        $this->dataService = new EducationDataService();
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
        Log::info("Entering and Exiting EducationBusinessService.findById(Int)");
        return $this->dataService->findById($id);
    }
    
    /**
     *
     * {@inheritDoc}
     * @see \App\business\BusinessServiceInterface::create()
     */
    public function create($object)
    {
        Log::info("Entering and Exiting EducationBusinessService.create(Education)");
        return $this->dataService->create($object);
    }
    
    /**
     *
     * {@inheritDoc}
     * @see \App\business\BusinessServiceInterface::update()
     */
    public function update($object)
    {
        Log::info("Entering and Exiting EducationBusinessService.update(Education)");
        return $this->dataService->update($object);
    }
    
    /**
     *
     * {@inheritDoc}
     * @see \App\business\BusinessServiceInterface::findBy()
     */
    public function findByObject($object)
    {
        Log::info("Entering and Exiting EducationBusinessService.findByObject(Education)");
        return $this->dataService->findByObject($object);
    }
    
    /**
     *
     * {@inheritDoc}
     * @see \App\business\BusinessServiceInterface::viewByParentId()
     */
    public function findByParent(int $parentId)
    {
        Log::info("Entering and Exiting EducationBusinessService.findByParent(Int)");
        return $this->dataService->findByParent($parentId);
    }
    
    /**
     *
     * {@inheritDoc}
     * @see \App\business\BusinessServiceInterface::delete()
     */
    public function delete($object)
    {
        Log::info("Entering and Exiting EducationBusinessService.delete(Education)");
        return $this->dataService->delete($object);
    }
    
    /**
     *
     * {@inheritDoc}
     * @see \App\business\BusinessServiceInterface::viewAll()
     */
    public function viewAll()
    {
        Log::info("Entering and Exiting EducationBusinessService.viewAll()");
        return $this->dataService->viewAll();
    }
}