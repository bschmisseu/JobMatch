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

use Illuminate\Validation\ValidationException;
use Exception;
use App\business\GroupBusinessService;
use Illuminate\Http\Request;
use App\model\Groups;
use App\business\GroupMemberBusinessService;
use App\model\GroupMembers;
use App\services\utility\LoggerInterface;

class GroupController extends Controller
{
    private $service;
    private $groupMemberService;
    
    protected $logger;
    
    /**
     * Defualt contstructor to initialize the Business Service object
     */
    function __construct(LoggerInterface $logger)
    {
        $this->service = new GroupBusinessService();
        $this->groupMemberService = new GroupMemberBusinessService();
        $this->logger = $logger; 
    }
    
    
    /**
     * Method to set the list of groups for the user
     * @throws ValidationException
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function groupListPage()
    {
        $this->logger->info("===Entering GroupController.groupListPage()");
        
        try
        {
            //Gets an array of all users within the database 
            $data = ['groups' => $this->service->viewAll()
            ];
            
            //returns the admin page view
            $this->logger->info("===Exiting GroupController.groupListPage() sent to GroupsPage");
            return view('groups')->with($data); 
        }
        
        catch(ValidationException $invalidException) {
            throw $invalidException;
        }
        
        catch (Exception $e) {
            $this->logger->error("===Error GroupController.groupListPage()", array("message" => $e->getMessage()));
            return view('errorPage');
        } 
    }
    
    /**
     * Interacts with the busienss service inorder to add a group to the database
     * @param Request $request
     * @throws ValidationException
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function addGroup(Request $request)
    {
        $this->logger->info("===Entering GroupController.addGroup()");
        
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
            $this->logger->info("===Exiting GroupController.addGroup() sent to GroupsPage");
            return $this->groupListPage();
        }
        
        catch(ValidationException $invalidException) {
            throw $invalidException;
        }
        
        catch (Exception $e) {
            $this->logger->error("===Error GroupController.addGroup()", array("message" => $e->getMessage()));
            return view('errorPage');
        } 
    }
    
    /**
     * Updates any name changes of a group 
     * @param Request $request
     * @throws ValidationException
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function editGroup(Request $request)
    {
        $this->logger->info("===Entering GroupController.editGroup()");
        
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
            $this->logger->info("===Exiting GroupController.editGroup() sent to GroupsPage");
            return $this->groupListPage();
        }
        
        catch(ValidationException $invalidException) {
            throw $invalidException;
        }
        
        catch (Exception $e) {
            $this->logger->error("===Error GroupController.editGroup()", array("message" => $e->getMessage()));
            return view('errorPage');
        } 
    }
    
    /**
     * Removes a group from the database and returns the user to the group list page
     * @param Request $request
     * @throws ValidationException
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function deleteGroup(Request $request)
    {
        $this->logger->info("===Entering GroupController.deleteGroup()");
        
        try
        {
            //Gathers all information from the html form
            $groupId = $request->input('groupId');
            $group = $this->service->findById($groupId);
            
            //Calls Busienss Service meethod to dlete the object within the database
            $this->service->delete($group);
            
            //Updates the sessions and send the user back to their profile page
            $this->logger->info("===Exiting GroupController.deleteGroup() sent to GroupsPage");
            return $this->groupListPage();
        }
        
        catch(ValidationException $invalidException) {
            throw $invalidException;
        }
        
        catch (Exception $e) {
            $this->logger->error("===Error GroupController.deleteGroup()", array("message" => $e->getMessage()));
            return view('errorPage');
        } 
    }
    
    /**
     * Gathers information on the current user and the group selected to add the user to the group 
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function joinGroup(Request $request)
    {
        $this->logger->info("===Entering GroupController.joinGroup()");
        
        try
        {
            $groupId = $request->input('groupId');
            $userId = $request->session()->get('currentUser')->getIdNum();
            
            $groupMember = new GroupMembers($groupId, $userId);
            
            $this->groupMemberService->create($groupMember);
            
            $this->logger->info("===Exiting GroupController.joinGroup() sent to GroupsPage");
            return $this->groupListPage();
        }
        
        catch (Exception $e) {
            $this->logger->error("===Error GroupController.joinGroup()", array("message" => $e->getMessage()));
            return view('errorPage');
        } 
    }
    
    /**
     * Gathers information on the user and the current group to remove the user from the group
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function leaveGroup(Request $request)
    {
        $this->logger->info("===Entering GroupController.leaveGroup()");
        
        try
        {
            $groupId = $request->input('groupId');
            $userId = $request->session()->get('currentUser')->getIdNum();
            
            $groupMember = new GroupMembers($groupId, $userId);
            
            $this->groupMemberService->delete($groupMember);
            
            $this->logger->info("===Exiting GroupController.leaveGroup() sent to GroupsPage");
            return $this->groupListPage();
        }
        
        catch (Exception $e) {
            $this->logger->error("===Error GroupController.leaveGroup()", array("message" => $e->getMessage()));
            return view('errorPage');
        }
    }
    
    /**
     * Method to validate the form data for a group addition
     * @param Request $request
     */
    private function validateFormGroup(Request $request)
    {
        $rules = [
            'groupName' => 'Required | Between:4,40 |'
        ];
        
        $this->validate($request, $rules);
    }
    
    /**
     * Method to validate the form data for a group edit
     * @param Request $request
     */
    private function validateEditGroup(Request $request)
    {
        $rules = [
            'editGroupName' => 'Required | Between:4,40 |'
        ];
        
        $this->validate($request, $rules);
    }
}
