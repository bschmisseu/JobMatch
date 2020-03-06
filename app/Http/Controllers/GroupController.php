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

use Illuminate\Validation\ValidationException;
use Exception;
use App\business\GroupBusinessService;
use Illuminate\Http\Request;
use App\model\Groups;

class GroupController extends Controller
{
    private $service;
    
    /**
     * Defualt contstructor to initialize the Business Service object
     */
    function __construct()
    {
        $this->service = new GroupBusinessService();
    }
    
    
    public function groupListPage()
    {
        try
        {
            //Gets an array of all users within the database 
            $data = ['groups' => $this->service->viewAll()
            ];
            
            //returns the admin page view
            return view('groups')->with($data); 
        }
        
        catch(ValidationException $invalidException) {
            throw $invalidException;
        }
        
        catch (Exception $e) {
            return view('errorPage');
        } 
    }
    
    public function addGroup(Request $request)
    {
        try
        {
            //Validates the form
            $this->validateFormGroup($request);
            
            //Gathers all information from the html form
            $groupString = $request->input('groupName');
            $userId = $request->session()->get('currentUser')->getIdNum();
            
            //Declasres and creates an object
            $currentGroup = new Groups(0, $groupString, $userId, array());
            
            //Calls business service method inorder to create the object within the database
            $this->service->create($currentGroup);
            
            //Updates the session and returns the user back to the profile page
            return $this->groupListPage();
        }
        
        catch(ValidationException $invalidException) {
            throw $invalidException;
        }
        
        catch (Exception $e) {
            return view('errorPage');
        } 
    }
    
    public function editGroup(Request $request)
    {
        try
        {
            //Validates form
            $this->validateEditGroup($request);
            
            //Gathers all information form the html form
            $groupId = $request->input('editGroupId');
            $groupName = $request->input('editGroupName');
            $userId = $request->session()->get('currentUser')->getIdNum();
            
            //Declares and creates an object
            $currentGroup = new Groups($groupId, $groupName, $userId, array());
            
            //Calls busienss service to update the object infromation
            $this->service->update($currentGroup);
            
            //Updates the sessions and send the user back to their profile page
            return $this->groupListPage();
        }
        
        catch(ValidationException $invalidException) {
            throw $invalidException;
        }
        
        catch (Exception $e) {
            return view('errorPage');
        } 
    }
    
    public function deleteGroup(Request $request)
    {
        try
        {
            //Gathers all information from the html form
            $groupId = $request->input('groupId');
            
            //Calls Busienss Service meethod to dlete the object within the database
            $this->service->delete($groupId);
            
            //Updates the sessions and send the user back to their profile page
            return $this->groupListPage();
        }
        
        catch(ValidationException $invalidException) {
            throw $invalidException;
        }
        
        catch (Exception $e) {
            return view('errorPage');
        } 
    }
    
    public function joinGroup(Request $request)
    {
        try
        {
            $groupId = $request->input('groupId');
            $userId = $request->session()->get('currentUser')->getIdNum();
            
            $this->service->joinGroup($groupId, $userId);
            
            return $this->groupListPage();
        }
        
        catch (Exception $e) {
            return view('errorPage');
        } 
    }
    
    public function leaveGroup(Request $request)
    {
        try
        {
            $groupId = $request->input('groupId');
            $userId = $request->session()->get('currentUser')->getIdNum();
            
            $this->service->leaveGroup($groupId, $userId);
            
            return $this->groupListPage();
        }
        
        catch (Exception $e) {
            return view('errorPage');
        }
    }
    
    private function validateFormGroup(Request $request)
    {
        $rules = [
            'groupName' => 'Required | Between:4,40 |'
        ];
        
        $this->validate($request, $rules);
    }
    
    private function validateEditGroup(Request $request)
    {
        $rules = [
            'editGroupName' => 'Required | Between:4,40 |'
        ];
        
        $this->validate($request, $rules);
    }
}
