<?php

/**
 * Bryce Schmisseur and Hermes Mimini
 * Job Match Application 3.0
 * JobListingController.php  1.0
 * March 8 2020
 *
 * Group controller in order to pass through data from the views to the buessiness methods
 */

namespace App\Http\Controllers;

use App\business\JobListingBusinessService;
use App\services\utility\LoggerInterface;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Exception;

class JobListingController extends Controller
{
    private $service;
    
    protected $logger;
    
    /**
     * Defualt contstructor to initialize the Business Service object
     */
    function __construct(LoggerInterface $logger)
    {
        $this->service = new JobListingBusinessService();
        $this->logger = $logger; 
    }
   
    /**
     * Displays all the joblisiting to the user
     * @throws ValidationException
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function jobListingPage()
    {
        $this->logger->info("===Entering JobListingController.jobListingPage()");
        
        try
        {
            //Gets an array of all users within the database
            $data = ['jobListings' => $this->service->viewAll()
            ];
            
            //returns the admin page view
            $this->logger->info("===Exiting JobListingController.jobListingPage() sent to JobListingPage");
            return view('jobListing')->with($data);
        }
        
        catch(ValidationException $invalidException) {
            throw $invalidException;
        }
        
        catch (Exception $e) {
            $this->logger->error("===Error JobListingController.jobListingPage()", array("message" => $e->getMessage()));
            return view('errorPage');
        } 
    }
    
    /**
     * Apply to job and sends the user back to the homepage
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function applyJobListing()
    {
        $this->logger->info("===Entering JobListingController.applyJobListing()");
        
        $data = ['returnApplyJob' => true];
        $this->logger->info("===Exiting JobListingController.applyJobListing() sent to JobListingPage");
        return view('homePage')->with($data);
    }
    
    /**
     * Takes in a search parameter to return a refined list of job listing list
     * @param Request $request
     * @throws ValidationException
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function searchJobListing(Request $request)
    {
        $this->logger->info("===Entering JobListingController.searchJobListing()");
        
        try
        {
            //Gets an array of all users within the database
            $data = ['jobListings' => $this->service->findByObject($request->input('searchParam'))
            ];
            
            //returns the admin page view
            $this->logger->info("===Exiting JobListingController.searchJobListing() sent to JobListingPage");
            return view('jobListing')->with($data);
        }
        
        catch(ValidationException $invalidException) {
            throw $invalidException;
        }
        
        catch (Exception $e) {
            $this->logger->error("===Error JobListingController.searchJobListing()", array("message" => $e->getMessage()));
            return view('errorPage');
        } 
    }
}
