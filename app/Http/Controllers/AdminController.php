<?php

/**
 * Bryce Schmisseur and Hermes Mimini
 * Job Match Application 3.0
 * AdminController.php  3.0
 * Febuary 23 2020
 *
 * Admin controller in order to pass through data from the views to the buessiness methods
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Exception;
use App\business\UserBusinessService; 
use App\business\JobListingBusinessService;
use App\model\JobListing;

class AdminController extends Controller
{
    private $service;
    private $jobListingService; 
    
    /**
     * Defualt contstructor to initialize the Business Service object
     */
    function __construct()
    {
        $this->service = new UserBusinessService();
        $this->jobListingService = new JobListingBusinessService();
    }
    
    /**
     * Directs the user to the admin page with an array of all users
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory - admin page
     */
    public function adminPage()
    {
        try
        {
            //Gets an array of all users within the database 
            $data = ['userList' => $this->service->viewAll(),
                     'jobListings' => $this->jobListingService->viewAll()
            ];
            
            //returns the admin page view
            return view('admin')->with($data); 
        }
        
        catch(ValidationException $invalidException) {
            throw $invalidException;
        }
        
        catch (Exception $e) {
            return view('errorPage');
        } 
    }
    
    /**
     * Method called when the admin is deleteing a users
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory - admin page
     */
    public function deleteUser(Request $request)
    {
        try 
        {
            //Gets the users id that is being requested to delete
            $userId = $request->input('userId');
            
            //Calls the business service to delete the user based on the user id given
            $this->service->delete($userId);
            
            //Refreshes the admin page with an updated list of users from the business service
            return $this->adminPage();
        }
        
        catch(ValidationException $invalidException) {
            throw $invalidException;
        }
        
        catch (Exception $e) {
            return view('errorPage');
        } 
    }
    
    /**
     * Mehtod called when the admin has requested to suspend a user
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory - admin page
     */
    public function suspendUser(Request $request)
    {
        try
        {
            //Gets the users id that is being requested to suspend
            $userId = $request->input('userId');
            
            //Gets the full user object from the business service based on the id
            $currentUser = $this->service->viewById($userId);
            
            //A decision to see if the user needs to be suspended or un suspended
            if($currentUser->isActive() == 1)
            {
                $currentUser->setActive(0);
            }
            
            else
            {
                $currentUser->setActive(1);
            }
            
            //Updates the users information by calling the update method within the business service
            $this->service->update($currentUser);
            
            //Refreshes the admin page with an updated list of the users
            return $this->adminPage();
        }
        
        catch(ValidationException $invalidException) {
            throw $invalidException;
        }
        
        catch (Exception $e) {
            return view('errorPage');
        } 
    }
    
    /**
     * Mehtod called with the admin is looking to get the full informaiton of the user
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory - users profile page
     */
    public function viewUser(Request $request)
    {
        try 
        {
            //Gets the users id that the request is made on the get more information 
            $userId = $request->input('userId');
            
            //Redirects the user to a page where all the information of the users is displayed with the users object
            $data = ['currentUser' => $this->service->viewById($userId)];
            return view('adminUserView')->with($data); 
        }
        
        catch(ValidationException $invalidException) {
            throw $invalidException;
        }
        
        catch (Exception $e) {
            return view('errorPage');
        } 
    }
    
    /**
     * Method to call the bueinss service in order to create the object within the databse
     * @param $request - Request: Input information from the page
     * @throws ValidationException: Exception thrown when the data validation fires
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory - users profile page
     */
    public function addJobListing(Request $request)
    {
        try 
        {
            //Validates form
            $this->validateFormJobListing($request);
            
            //Gathers all inforamtion from the database
            $position = $request->input('jobPosition');
            $companyName = $request->input('companyName');
            $salary = $request->input('jobSalary');
            $jobSkills = $request->input('jobSkills');
            $jobDescription = $request->input('jobDescription');
            
            //Declares and creates an object
            $currentJobListing = new JobListing(0, $companyName, $position, $salary, $jobSkills, $jobDescription);
            
            //Calls business service method to create the object with in the databse
            $this->jobListingService->create($currentJobListing);
            
            //Updates the sessions and sends the user back to the admin page
            return $this->adminPage();
        }
        
        catch(ValidationException $invalidException) {
            throw $invalidException;
        }
        
        catch (Exception $e) {
            return view('errorPage');
        } 
    }
    
    /**
     * Delete job interacts with the business service inorder to delete the object from the database
     * @param $request - Request: Input information from the page
     * @throws ValidationException: Exception thrown when the data validation fires
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory - users profile page
     */
    public function deleteJobListing(Request $request)
    {
        try 
        {
            //Gathers all information from the html form
            $jobListingId = $request->input('jobListingId');
            
            //Calls busienss service method in order to delete it within the database
            $this->jobListingService->delete($jobListingId);
            
            //Updates the sessions and sends the user back to the admin page
            return $this->adminPage();
        }
        
        catch(ValidationException $invalidException) {
            throw $invalidException;
        }
        
        catch (Exception $e) {
            return view('errorPage');
        } 
    }
    
    /**
     * Updates the objects information using the business service
     * @param $request - Request: Input information from the page
     * @throws ValidationException: Exception thrown when the data validation fires
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory - users profile page
     */
    public function editJobListing(Request $request)
    {
        try 
        {
            //Validates form
            $this->validateEditJobListing($request);
            
            //Gathers all information from the html form
            $position = $request->input('jobPosition');
            $companyName = $request->input('companyName');
            $salary = $request->input('jobSalary');
            $jobSkills = $request->input('jobSkills');
            $jobDescription = $request->input('jobDescription');
            $id = $request->input('jobListingId');
            
            $currentJobListing = new JobListing($id, $companyName, $position, $salary, $jobSkills, $jobDescription);
            
            //Calls business service method to update information within the database
            $this->jobListingService->update($currentJobListing);

            //Updates the sessions and sends the user back to the admin page
            return $this->adminPage();
        }
        
        catch(ValidationException $invalidException) {
            throw $invalidException;
        }
        
        catch (Exception $e) {
            return view('errorPage');
        } 
    }
    
    /**
     * Function to validate the information with in the html form
     * @param $request - Request: Input information from the page
     */
    private function validateFormJobListing(Request $request)
    {
        $rules = [
            'jobPosition' => 'Required | Between:4,20 | Alpha',
            'companyName' => 'Required | Between:4,20 | Alpha',
            'jobSalary' => 'Required | numeric',
            'jobSkills' => 'Required | Between:4,20',
            'jobDescription' => 'Required | Between:9,200'
        ];
        
        $this->validate($request, $rules);
    }
    
    /**
     * Function to validate the information with in the html form
     * @param $request - Request: Input information from the page
     */
    private function validateEditJobListing(Request $request)
    {
        $rules = [
            'editJobPosition' => 'Required | Between:4,20 | Alpha',
            'editCompanyName' => 'Required | Between:4,20 | Alpha',
            'editJobSalary' => 'Required | numeric',
            'editJobSkills' => 'Required | Between:4,20',
            'editJobDescription' => 'Required | Between:9,200'
        ];
        
        $this->validate($request, $rules);
    }
}
