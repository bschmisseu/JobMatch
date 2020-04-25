<?php

/**
 * Bryce Schmisseur and Hermes Mimini
 * Job Match Application 2.0
 * UserRestController.php  1.0
 * April 19 2020
 *
 * A contoller to mimin a rest service for the users models
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\business\UserBusinessService;
use App\model\DTO;
use App\business\JobBusinessService;
use App\business\EducationBusinessService;
use App\business\SkillBusinessService;

class UsersRestController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try
        {
            //Constructs object to access the business services
            $usersService = new UserBusinessService();
            $jobService = new JobBusinessService();
            $educationService = new EducationBusinessService();
            $skillService = new SkillBusinessService();
            
            //Gets all users from the database
            $users = $usersService->viewAll();
            
            //For loop to constuct the full user model from all business services
            for($i = 0; $i < count($users); $i++)
            {
                $id = $users[$i]->getIdNum();
                
                $currentUser = $usersService->findById($id);
                $currentEducations = $educationService->findByParent($id);
                $currentJobs = $jobService->findByParent($id);
                $currentSkills = $skillService->findByParent($id);
                
                $currentUser->getUserInformation()->setEducationHistory($currentEducations);
                $currentUser->getUserInformation()->setJobs($currentJobs);
                $currentUser->getUserInformation()->setSkills($currentSkills);
                
                $users[$i] = $currentUser;
            }
            
            //Constucts a DTO object to signify a successfull request with the array of users
            $dto = new DTO(0, "Ok", $users);
            
            $json = json_encode($dto);
            
            return $json;
        }
        
        catch(Exception $e)
        {
            //Constucts a DTO object to signify the request was not process correctly
            $dto = new DTO(-2, $e->getMessage(), array());
            
            $json = json_encode($dto);
            
            return $json;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try
        {
            //Constructs object to access the business services
            $usersService = new UserBusinessService();
            $jobService = new JobBusinessService();
            $educationService = new EducationBusinessService();
            $skillService = new SkillBusinessService();
            
            $currentUser = $usersService->findById($id);
            $currentEducations = $educationService->findByParent($id);
            $currentJobs = $jobService->findByParent($id);
            $currentSkills = $skillService->findByParent($id);
            
            $currentUser->getUserInformation()->setEducationHistory($currentEducations);
            $currentUser->getUserInformation()->setJobs($currentJobs);
            $currentUser->getUserInformation()->setSkills($currentSkills);
            
            //Constucts a DTO object to signify a successfull request with the array of userss
            $dto = new DTO(0, "Ok", $currentUser);
            
            $json = json_encode($dto);
            
            return $json;
        }
        
        catch(Exception $e)
        {
            //Constucts a DTO object to signify the request was not process correctly
            $dto = new DTO(-2, $e->getMessage(), array());
            
            $json = json_encode($dto);
            
            return $json;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
