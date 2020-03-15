@extends('layouts.appmaster')
@section('title', 'Job Match: Job Listings')

@section('content')
    <link rel="stylesheet" href="resources/style/adminPage.css">
    <link rel="stylesheet" href="resources/style/popup_style.css">
    <script src="resources/js/popup_script.js"></script>
	
	<div class="container" style="font-size: 13px">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-5">
						<h2>Job <b>Listings</b></h2>
					</div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Company Name</th>						
						<th>Position</th>
						<th>Salary</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($jobListings as $job)
                <tr style="text-align: center">
               		<td>{{$job->getId()}}</td>
               		<td>{{$job->getCompanyName()}}</td>
               		<td><a style="cursor: pointer" onclick="openApplyJobListingForm({{$job->getId()}}, '{{$job->getCompanyName()}}', '{{$job->getPosition()}}', {{$job->getSalary()}}, '{{$job->getSkills()}}', '{{$job->getDescription()}}')">{{$job->getPosition()}}</a></td>
               		<td>${{$job->getSalary()}}.00</td>
       			</tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    <div id=applyJobListingForm>	
    	<h2>Apply For Job</h2>
        <form method= "POST" action= "applyJobListing">
        	<input type="hidden" name ="_token" value="<?php echo csrf_token()?>"/>
        	<input type="hidden" id="applyJobListingId" name="jobListingId" value="-1">
        	<table style="width: 100%">
        		<tr>
            		<td>
            			<div class="form-group">
                            <label class="col-md-13 control-label" for="jobPosition">Position</label>  
                            <div class="col-md-13">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-briefcase"></i>
                                    </span>
                                	<input value="" id="applyJobPosition" name="jobPosition" type="text" placeholder="Job Position" class="form-control input-md">
                            	</div>
            				</div>
            			</div>	
            		</td>
        		</tr>
            		<tr>
            		<td>
            			<div class="form-group">
                            <label class="col-md-13 control-label" for="companyName">Company Name</label>  
                            <div class="col-md-13">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-briefcase"></i>
                                    </span>
                                	<input value="" id="applyCompanyName" name="companyName" type="text" placeholder="Company Name" class="form-control input-md">
                            	</div>
            				</div>
            			</div>
            		</td>
        		</tr>
        		<tr>
            		<td>
            			<div class="form-group">
                            <label class="col-md-13 control-label" for="jobSalary">Salary</label>  
                            <div class="col-md-13">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-usd"></i>
                                    </span>
                                	<input value="" id="applyJobSalary" name="jobSalary" type="text" placeholder="Salary" class="form-control input-md">
                            	</div>
            				</div>
            			</div>
            		</td>
        		</tr>
        		<tr>
            		<td>
            			<div class="form-group">
                            <label class="col-md-13 control-label" for="jobSkills">Skills</label>  
                            <div class="col-md-13">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-bullseye"></i>
                                    </span>
                                	<input value="" id="applyJobSkills" name="jobSkills" type="text" placeholder="Skills" class="form-control input-md">
                            	</div>
            				</div>
            			</div>
            		</td>
        		</tr>
        		<tr>
            		<td>
            			<div class="form-group">
                            <label class="col-md-13 control-label" for="editJobDescription">Description (max 200 words)</label>
                            <div class="col-md-13">                     
                            	<textarea class="form-control" rows="2"  id="applyJobDescription" name="editJobDescription"></textarea>
                            </div>
                        </div>
            		</td>
        		</tr>
        		<tr align="center" style="width: 100%;">
        			<td>
        				<input type= "submit" value= "Apply" class="btn btn-primary">
        			</td>
        		</tr>
        	</table>
        </form>
    </div>

	<script type="text/javascript">
    var errorList = "Error List: "; 
    @if ($errors->any())
    	@foreach ($errors->all() as $error)
    		errorList += "\n{{$error}}";
    	@endforeach
    	alert(errorList);
    @endif
    </script>

@endsection