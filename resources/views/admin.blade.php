@extends('layouts.appmaster')
@section('title', 'Job Match: Admin')

@section('content')
<link rel="stylesheet" href="resources/style/adminPage.css">
<link rel="stylesheet" href="resources/style/popup_style.css">
<script src="resources/js/popup_script.js"></script>
<br>
    <div class="container" style="font-size: 13px">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-5">
						<h2>User <b>Management</b></h2>
					</div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>						
						<th>User Name</th>
						<th>Role</th>
                        <th>Status</th>
						<th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($userList as $user)
                    <tr style="text-align: center">
                        <td>{{$user->getIdNum()}}</td>
                        <td>
                        <form method="POST" action="adminViewUser" id="userProfileForm{{$user->getIdNum()}}" style="vertical-align: middle">
                        	<input type="hidden" name ="_token" value="<?php echo csrf_token()?>"/>
                        	<input type="hidden" name="userId" value="{{$user->getIdNum()}}">
                        	<a style="cursor: pointer" onclick="document.getElementById('userProfileForm{{$user->getIdNum()}}').submit();">{{$user->getFirstName()}}</a>
                        </form>
                        </td>
                        <td>{{$user->getUserCredential()->getUserName()}}</td>
                        @if($user->getUserRole() == 0)                        
                        	<td>Admin</td>
                        @else
                        	<td>User</td>
                    	@endif
                    	@if($user->isActive())
							<td><span class="status text-success">&bull;</span> Active</td>
						@else
							<td><span class="status text-danger">&bull;</span> Suspended</td>
						@endif
						<td>
						@if(session()->get('currentUser')->getIdNum() != $user->getIdNum())
    						<form method= "POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to suspend this user?')">
    							<input type="hidden" name ="_token" value="<?php echo csrf_token()?>"/>
    							<input type="hidden" name="userId" value="{{$user->getIdNum()}}">
    							<button formaction="suspendUser" class="pause" title="Pause" data-toggle="tooltip"><i class="material-icons">&#xe14b;</i></button>
    						</form>
    						<form method= "POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this user?')">
    							<input type="hidden" name ="_token" value="<?php echo csrf_token()?>"/>
    							<input type="hidden" name="userId" value="{{$user->getIdNum()}}">
    							<button formaction="deleteUser" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE5C9;</i></button>
    						</form>
						@endif
						</td>
                    </tr>
                  @endforeach 
                </tbody>
            </table>
        </div>
    </div> 
    
    <div class="container" style="font-size: 13px">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-5">
						<h2>Job <b>Listings</b></h2>
					</div>
					<div class="col-sm-7">
						<a onclick="openJobListingForm()" class="btn btn-primary"><i class="material-icons">&#xE147;</i> <span>Add New Job Listing</span></a>					
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
						<th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($jobListings as $job)
                <tr style="text-align: center">
               		<td>{{$job->getId()}}</td>
               		<td>{{$job->getCompanyName()}}</td>
               		<td>{{$job->getPosition()}}</td>
               		<td>${{$job->getSalary()}}.00</td>
               		<td>
    					<button onclick="openEditJobListingForm({{$job->getId()}}, '{{$job->getCompanyName()}}', '{{$job->getPosition()}}', {{$job->getSalary()}}, '{{$job->getSkills()}}', '{{$job->getDescription()}}')" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xe150;</i></button>
    					<form method= "POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this job listing?')">
    						<input type="hidden" name ="_token" value="<?php echo csrf_token()?>"/>
    						<input type="hidden" name="jobListingId" value="{{$job->getId()}}">
    						<button formaction="deleteJobListing" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE5C9;</i></button>
    					</form>	
    				</td>
       			</tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    <div id="addJobListingForm">	
    	<h2>Add Job Listing</h2>
        <form method= "POST" action= "addJobListing">
        	<input type="hidden" name ="_token" value="<?php echo csrf_token()?>"/>
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
                                	<input id="jobPosition" name="jobPosition" type="text" placeholder="Job Position" class="form-control input-md">
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
                                	<input id="companyName" name="companyName" type="text" placeholder="Company Name" class="form-control input-md">
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
                                	<input id="jobSalary" name="jobSalary" type="text" placeholder="Salary" class="form-control input-md">
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
                                	<input id="jobSkills" name="jobSkills" type="text" placeholder="Skills" class="form-control input-md">
                            	</div>
            				</div>
            			</div>
            		</td>
        		</tr>
        		<tr>
            		<td>
            			<div class="form-group">
                            <label class="col-md-13 control-label" for="jobDescription">Description (max 200 words)</label>
                            <div class="col-md-13">                     
                            	<textarea class="form-control" rows="2"  id="jobDescription" name="jobDescription"></textarea>
                            </div>
                        </div>
            		</td>
        		</tr>
        		<tr align="center" style="width: 100%;">
        			<td>
        				<input type= "submit" value= "Add Job Listing" class="btn btn-primary">
        			</td>
        		</tr>
        	</table>
        </form>
    </div>
    
    <div id=editJobListingForm>	
    	<h2>Edit Job Listing</h2>
        <form method= "POST" action= "editJobListing">
        	<input type="hidden" name ="_token" value="<?php echo csrf_token()?>"/>
        	<input type="hidden" id="editJobListingId" name="jobListingId" value="-1">
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
                                	<input value="" id="editJobPosition" name="jobPosition" type="text" placeholder="Job Position" class="form-control input-md">
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
                                	<input value="" id="editCompanyName" name="companyName" type="text" placeholder="Company Name" class="form-control input-md">
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
                                	<input value="" id="editJobSalary" name="jobSalary" type="text" placeholder="Salary" class="form-control input-md">
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
                                	<input value="" id="editJobSkills" name="jobSkills" type="text" placeholder="Skills" class="form-control input-md">
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
                            	<textarea class="form-control" rows="2"  id="editJobDescription" name="editJobDescription"></textarea>
                            </div>
                        </div>
            		</td>
        		</tr>
        		<tr align="center" style="width: 100%;">
        			<td>
        				<input type= "submit" value= "Edit Job Listing" class="btn btn-primary">
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