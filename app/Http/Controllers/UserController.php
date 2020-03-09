<?php

/**
 * Bryce Schmisseur and Hermes Mimini
 * Job Match Application 2.0
 * LoginRegistrationController.php  2.0
 * Febuary 5 2020
 *
 * LoginRegistrationController in order to pass through data from the views to the buessiness methods
 */

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Exception;
use App\model\User;
use App\business\UserBusinessService;
use App\model\UserCredential;
use App\model\UserInformation;
use App\model\Education;
use App\business\JobBusinessService;
use App\business\EducationBusinessService;
use App\model\Job;
use App\business\SkillBusinessService;
use App\model\Skill;

session_start(); 

class UserController extends Controller
{
    private $service;
    private $educationService;
    private $jobService;
    private $skillService; 
    
    /**
     * Defualt contstructor to initialize the Business Service object
     */
    function __construct()
    {
        $this->service = new UserBusinessService();
        $this->jobService = new JobBusinessService();
        $this->educationService = new EducationBusinessService();
        $this->skillService = new SkillBusinessService();
    }
    
    /**
     * Controller method when the user is trying to log in to make sure the user if valid before leading them to the homepage
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory - home page
     */
    public function authenticateUser(Request $request)
    {
//         try
//         {
            $this->validateForm($request);
            
            //Gathers the inforamtion from the login form
            $userName = $request->input('userName');
            $password = $request->input('password');
            
            //Creates a full user model inorder to send to the buessiness service
            $userCredentials = new UserCredential($userName, $password);
            
            //Calls a business service method inorder to see if the user is able to login 
            $returnNum = $this->service->authenticate($userCredentials);
            
            //Checks to see if the user id valid
            if($returnNum > 1)
            {
                $currentUser = $this->getCurrentUser($returnNum);  
                //A descision is made to see if the account has been suspended
                if($currentUser->isActive() == 1)
                {
                    //If the user is not suspended it will send the user to the homepage after setting the session of blade
                    $_SESSION['currentUser'] = $currentUser;
                    $request->session()->put('currentUser', $currentUser);
                    $data = ['returnMessage' => "Welcome Back " . $currentUser->getFirstName()];
                    return view('homePage')->with($data);
                }
                
                else 
                {
                    //If the users account has been disabled the user will be sent back to the login form with an error messages displaying such
                    $data = ['returnMessage' => "Your Account Has Been Temporarily Disabled!"];
                    return view('login')->with($data);
                }
            }
            
            else
            {
                //If not user credentials match then the user will be sent back to the login form
                $data = ['returnMessage' => "Incorrect User Name or Password!"];
                return view('login')->with($data);
            }
//         }
        
//         catch(ValidationException $invalidException) {
//             throw $invalidException;
//         }
        
//         catch (Exception $e) {
//             //return $e->getMessage();
//             return view('errorPage');
//         }   
    }
    
    /**
     * Controller method that takes in all information from registration form to push the information to the database
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory - home page
     */
    public function registerUser(Request $request)
    {
//         try 
//         {
            $this->validateFormUser($request);
            
            //Gathers all information from the registration form
            $firstName =  $request->input('firstName');
            $lastName =  $request->input('lastName');
            $phoneNumber =  $request->input('phoneNumber');
            $email =  $request->input('email');
            $userName =  $request->input('userName');
            $password =  $request->input('password');
            
            //Creates a full user object based on the information given
            $userCredentials = new UserCredential($userName, $password);
            $userInfo = new UserInformation("", null, null, null);
            $user = new User(0, $firstName, $lastName, $email, $phoneNumber, 1, 1, $userCredentials, $userInfo);
            
            //Calls a business service method inorder to write the user into the database
            $result = $this->service->create($user);
            
            //Decision to determin the outcome of the query
            if($result == 1)
            {
                //If there was no problem it will send the user to the home page 
                $request->session()->put('currentUser', $_SESSION['currentUser']);
                $data = ['returnMessage' => "Thank you for Joining "  . $user->getFirstName()];
                return view('homePage')->with($data);
            }
            
            else if($result == 5)
            {
                //If the users information was already in the data base they were sent back to the registration form
                $data = ['returnMessage' => "User Name Already Taken!"];
                return view('registration')->with($data); 
            }
            
            else
            {
                //If there was an error proccessing their request they were sent back to the registration form
                $data = ['returnMessage' => "Error Processing Request!"];
                return view('login')->with($data); 
            }
//         }
        
//         catch(ValidationException $invalidException) {
//             throw $invalidException;
//         }
        
//         catch (Exception $e) {
//             echo "<script>console.log('Register User " . $e->getMessage() . "')</script>";
//             return view('errorPage');
//         } 
    }
    
    /**
     * Method to call the bueinss service in order to create the object within the databse
     * @param $request - Request: Input information from the page
     * @throws ValidationException: Exception thrown when the data validation fires
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory - users profile page
     */
    public function addEducation(Request $request)
    {
        try
        {   
            //Validate the form
            $this->validateFormEducation($request);
            
            //Gathers all the inforamtion from the hmtl form
            $schoolName = $request->input('schoolName');
            $degree = $request->input('degree');
            $field = $request->input('field');
            $startDate = $request->input('educationStartDate');
            $endDate = $request->input('educationEndDate');
            $description = $request->input('educationDescription');
            $userId = $request->session()->get('currentUser')->getIdNum();
            
            //Declares and creates an object
            $currentEducation = new Education(0, $schoolName, $degree, $field, $startDate, $endDate, $description, $userId);
            
            //Calls bussiness service method to create the object with in the datasbase
            $this->educationService->create($currentEducation);
            
            //Updates the sessions and returns the user back to the profile page
            $currentUser = $this->getCurrentUser($userId);
            $_SESSION['currentUser'] = $currentUser;
            $request->session()->put('currentUser', $currentUser);
            return view('profile');
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
    public function addJob(Request $request)
    {
        try  
        {
            //Validates form
            $this->validateFormJob($request);
            
            //Gathers all inforamtion from the database
            $jobTitle = $request->input('jobTitle');
            $companyName = $request->input('companyName');
            $startDate = $request->input('jobStartDate');
            $endDate = $request->input('jobEndDate');
            $jobDescription = $request->input('jobDescription');
            $userId = $request->session()->get('currentUser')->getIdNum();
            
            //Declares and creates an object
            $currentJob = new Job(0, $jobTitle, $companyName, $startDate, $endDate, $jobDescription, $userId);
            
            //Calls business service method to create the object with in the databse
            $this->jobService->create($currentJob);
            
            //Updates the sessions and sends the user back to their profile page
            $currentUser = $this->getCurrentUser($userId);
            $_SESSION['currentUser'] = $currentUser;
            $request->session()->put('currentUser', $currentUser);
            return view('profile');
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
    public function addSkill(Request $request)
    {
        try 
        {
            //Validates the form
            $this->validateFormSkill($request);
            
            //Gathers all information from the html form
            $skillString = $request->input('skillString');
            $userId = $request->session()->get('currentUser')->getIdNum();
            
            //Declasres and creates an object
            $currentSkill = new Skill(0, $skillString, $userId);
            
            //Calls business service method inorder to create the object within the database
            $this->skillService->create($currentSkill);
            
            //Updates the session and returns the user back to the profile page
            $currentUser = $this->getCurrentUser($userId);
            $_SESSION['currentUser'] = $currentUser;
            $request->session()->put('currentUser', $currentUser);
            return view('profile');
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
    public function deleteEducation(Request $request)
    {
        try 
        {
            //Gathers all information from the html form
            $educationId = $request->input('educationId');
            $userId = $request->session()->get('currentUser')->getIdNum();
            
            //Calls busienss service method in order to delete it within the database
            $this->educationService->delete($educationId);
            
            //Updates the sessions and send the user back to their profile page
            $currentUser = $this->getCurrentUser($userId);
            $_SESSION['currentUser'] = $currentUser;
            $request->session()->put('currentUser', $currentUser);
            return view('profile');
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
    public function deleteJob(Request $request)
    {
        try
        {   
            //Gathers all information from the html form
            $jobId = $request->input('jobId');
            $userId = $this->jobService->viewById($jobId)->getUserId();
            
            //Calls Busienss Service meethod to dlete the object within the database
            $this->jobService->delete($jobId);
            
            //Updates the sessions and send the user back to their profile page
            $currentUser = $this->getCurrentUser($userId);
            $_SESSION['currentUser'] = $currentUser;
            $request->session()->put('currentUser', $currentUser);
            return view('profile');
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
    public function deleteSkill(Request $request)
    {
        try
        {
            //Gathers all information from the html form
            $skillId = $request->input('skillId');
            $userId = $request->session()->get('currentUser')->getIdNum();
            
            //Calls Busienss Service meethod to dlete the object within the database
            $this->skillService->delete($skillId);
            
            //Updates the sessions and send the user back to their profile page
            $currentUser = $this->getCurrentUser($userId);
            $_SESSION['currentUser'] = $currentUser;
            $request->session()->put('currentUser', $currentUser);
            return view('profile');
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
    public function openEducationEdit(Request $request)
    {
        try
        {
            //Gathers all information from the html form
            $educationNum = $request->input('educationNum');
            $currentUser = $request->session()->get('currentUser');
            $educationList = $currentUser->getUserInformation()->getEducationHistory();
            $educationList[$educationNum]->setEdit(TRUE);
            $currentUser->getUserInformation()->setEducationHistory($educationList);
            
            //Updates the sessions and send the user back to their profile page
            $_SESSION['currentUser'] = $currentUser;
            $request->session()->put('currentUser', $currentUser);
            return view('profile');
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
    public function openJobEdit(Request $request)
    {
        try
        {
            //Gathers all information from the html form
            $jobNum = $request->input('jobNum');
            $currentUser = $request->session()->get('currentUser');
            $jobList = $currentUser->getUserInformation()->getJobs();
            $jobList[$jobNum]->setEdit(TRUE);
            $jobList = $currentUser->getUserInformation()->setJobs($jobList);
            
            //Updates the sessions and send the user back to their profile page
            $_SESSION['currentUser'] = $currentUser;
            $request->session()->put('currentUser', $currentUser);
            return view('profile');
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
    public function editEducation(Request $request)
    {
        try
        {
            //Validates form
            $this->validateFormEducation($request);
            
            //Gathers all inforamtion from the html form
            $schoolName = $request->input('schoolName');
            $degree = $request->input('degree');
            $field = $request->input('field');
            $startDate = $request->input('educationStartDate');
            $endDate = $request->input('educationEndDate');
            $description = $request->input('educationDescription');
            $userId = $request->session()->get('currentUser')->getIdNum();
            $educationId = $request->input('educationId');
            
            //Declares and creates object
            $currentEducation = new Education($educationId, $schoolName, $degree, $field, $startDate, $endDate, $description, $userId);
            
            //calls business service method to update the objects information in the databse
            $this->educationService->update($currentEducation);
            
            //Updates the sessions and send the user back to their profile page
            $currentUser = $this->getCurrentUser($userId);
            $_SESSION['currentUser'] = $currentUser;
            $request->session()->put('currentUser', $currentUser);
            return view('profile');
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
    public function editJob(Request $request)
    {
        try
        {
            //Validates form
            $this->validateFormJob($request);
            
            //Gathers all information form the html form
            $jobTitle = $request->input('jobTitle');
            $companyName = $request->input('companyName');
            $startDate = $request->input('jobStartDate');
            $endDate = $request->input('jobEndDate');
            $jobDescription = $request->input('jobDescription');
            $userId = $request->session()->get('currentUser')->getIdNum();
            $jobId = $request->input('jobId');
            
            //Declares and creates object
            $currentJob = new Job($jobId, $jobTitle, $companyName, $startDate, $endDate, $jobDescription, $userId);
            
            //Calls business service method to update information within the database
            $this->jobService->update($currentJob);

            //Updates the sessions and send the user back to their profile page
            $currentUser = $this->getCurrentUser($userId);
            $_SESSION['currentUser'] = $currentUser;
            $request->session()->put('currentUser', $currentUser);
            return view('profile');
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
    public function editSkill(Request $request)
    {
        try
        {
            //Validates form
            $this->validateEditSkill($request);
            
            //Gathers all information form the html form
            $skillId = $request->input('skillId');
            $skillString = $request->input('editSkillString');
            $userId = $request->session()->get('currentUser')->getIdNum();
            
            //Declares and creates an object
            $currentSkill = new Skill($skillId, $skillString, $userId);
            
            //Calls busienss service to update the object infromation
            $this->skillService->update($currentSkill);
            
            //Updates the sessions and send the user back to their profile page
            $currentUser = $this->getCurrentUser($userId);
            $_SESSION['currentUser'] = $currentUser;
            $request->session()->put('currentUser', $currentUser);
            return view('profile');
        }
        
        catch(ValidationException $invalidException) {
            throw $invalidException;
        }
        
        catch (Exception $e) {
            return view('errorPage');
        } 
    }
    
    /**
     * Logout method that gets called when the user is trying to logout
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory - the index page
     */
    public function logout(Request $request)
    {
        //Forgets the current user within the session
        $request->session()->forget('currentUser');
        
        //Returns the user to the index page
        return view('index');
    }
    
    private function getCurrentUser(int $id)
    {
        try
        {
            $currentUser = $this->service->viewById($id);
            $currentEducations = $this->educationService->viewByParentId($id);
            $currentJobs = $this->jobService->viewByParentId($id);
            $currentSkills = $this->skillService->viewByParentId($id);
            
            $currentUser->getUserInformation()->setEducationHistory($currentEducations);
            $currentUser->getUserInformation()->setJobs($currentJobs);
            $currentUser->getUserInformation()->setSkills($currentSkills);
            
            return $currentUser;
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
    private function validateForm(Request $request)
    {
        $rules = ['userName' => 'Required | Between:4,20 | Alpha',
            'password' => 'Required | Between:4,20'];
        
        $this->validate($request, $rules);
    }
    
    /**
     * Function to validate the information with in the html form
     * @param $request - Request: Input information from the page
     */
    private function validateFormUser(Request $request)
    {
        $rules = [
            'firstName' => 'Required | Between:4,20',
            'lastName' => 'Required | Between:4,20',
            'userName' => 'Required | Between:4,20',
            'password' => 'Required | Between:4,20',
            'email' => 'Required | email',
            'phoneNumber' => 'Required | Between:9,20'
        ];
        
        $this->validate($request, $rules);
    }
    
    /**
     * Function to validate the information with in the html form
     * @param $request - Request: Input information from the page
     */
    private function validateFormEducation(Request $request)
    {
        $rules = [
            'schoolName' => 'Required | Between:4,40',
            'degree' => 'Required | Between:4,20',
            'field' => 'Required | Between:4,20 ',
            'educationStartDate' => 'Required | date_format:"Y-m-d"',
            'educationEndDate' => 'Required | date_format:"Y-m-d"',
            'educationDescription' => 'Required | Between:4,200'
        ];
        
        $this->validate($request, $rules);
    }
    
    /**
     * Function to validate the information with in the html form
     * @param $request - Request: Input information from the page
     */
    private function validateFormJob(Request $request)
    {
        $rules = [
            'jobTitle' => 'Required | Between:4,40 ',
            'companyName' => 'Required | Between:4,20 ',
            'jobStartDate' => 'Required | date_format:"Y-m-d"',
            'jobEndDate' => 'Required | date_format:"Y-m-d"',
            'jobDescription' => 'Required | Between:4,200'
        ];
        
        $this->validate($request, $rules);
    }
    
    /**
     * Function to validate the information with in the html form
     * @param $request - Request: Input information from the page
     */
    private function validateEditSkill(Request $request)
    {
        $rules = [
            'editSkillString' => 'Required | Between:4,40 '
        ];
        
        $this->validate($request, $rules);
    }
    
    /**
     * Function to validate the information with in the html form
     * @param $request - Request: Input information from the page
     */
    private function validateFormSkill(Request $request)
    {
        $rules = [
            'skillString' => 'Required | Between:4,40'
        ];
        
        $this->validate($request, $rules);
    }
    
    
}
