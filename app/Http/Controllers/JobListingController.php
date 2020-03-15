<?php

/**
 * Bryce Schmisseur and Hermes Mimini
 * Job Match Application 3.0
 * GroupController.php  1.0
 * March 8 2020
 *
 * Group controller in order to pass through data from the views to the buessiness methods
 */

namespace App\Http\Controllers;

use App\business\JobListingBusinessService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Exception;

class JobListingController extends Controller
{
    private $service;
    
    /**
     * Defualt contstructor to initialize the Business Service object
     */
    function __construct()
    {
        $this->service = new JobListingBusinessService();
    }
   
    public function jobListingPage()
    {
        try
        {
            //Gets an array of all users within the database
            $data = ['jobListings' => $this->service->viewAll()
            ];
            
            //returns the admin page view
            return view('jobListing')->with($data);
        }
        
        catch(ValidationException $invalidException) {
            throw $invalidException;
        }
        
        catch (Exception $e) {
            return view('errorPage');
        } 
    }
    
    public function applyJobListing()
    {
        $data = ['returnApplyJob' => true];
        return view('homePage')->with($data);
    }
    
    public function searchJobListing(Request $request)
    {
        try
        {
            //Gets an array of all users within the database
            $data = ['jobListings' => $this->service->findByObject($request->input('searchParam'))
            ];
            
            //returns the admin page view
            return view('jobListing')->with($data);
        }
        
        catch(ValidationException $invalidException) {
            throw $invalidException;
        }
        
        catch (Exception $e) {
            return view('errorPage');
        } 
    }
}
