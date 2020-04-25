<?php

/**
 * Bryce Schmisseur and Hermes Mimini
 * Job Match Application 2.0
 * JobRestController.php  1.0
 * April 19 2020
 *
 * A contoller to mimin a rest service for the Job listing models
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\model\DTO;
use App\business\JobListingBusinessService;

class JobsRestController extends Controller
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
            $jobsService = new JobListingBusinessService();
            $jobs = $jobsService->viewAll();
            
            $dto = new DTO(0, "Ok", $jobs);
            
            $json = json_encode($dto);
            
            return $json;
        }
        
        catch(Exception $e)
        {
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
            $jobsService = new JobListingBusinessService();
            $jobs = $jobsService->findById($id);
            
            $dto = new DTO(0, "Ok", $jobs);
            
            $json = json_encode($dto);
            
            return $json;
        }
        
        catch(Exception $e)
        {
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
