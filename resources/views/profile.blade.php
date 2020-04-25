@extends('layouts.appmaster')
@section('title', 'Job Match: Profile')

@section('content')
<link rel="stylesheet" href="resources/style/adminPage.css">
<link rel="stylesheet" href="resources/style/popup_style.css">
<script src="resources/js/popup_script.js"></script>

<br>
    <div style="font-size: 13px; width: 95%">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-5">
						<h2>User <b>Profile</b></h2>
					</div>
                </div>
            </div>
            <table style="width: 100%; text-align: center; border: collapse">
            	<tr>
            		<td style="border-right: 1px solid #c2c2c2; width: 25%">
            			<h4>User Information</h4>
            		</td>
            		<td style="border-right: 1px solid #c2c2c2; width: 25%">
            			<h4>User Education History</h4>
            		</td>
            		<td style="border-right: 1px solid #c2c2c2; width: 25%">
            			<h4>User Job History</h4>
            		</td>
            		<td style="width: 25%; border-right: 1px solid #c2c2c2;">
            			<h4>User Skills</h4>
            		</td>
            	</tr>
                <tr>
                	<td style="border-right: 1px solid #c2c2c2" valign="top">
<!--                 		User Information -->
                        <table style="text-align: left; width: 100%">
                            <tr>
                            	<td>
                                   <!-- Firstname Name -->
                                    <div class="form-group">
                                        <label class="col-md-8 control-label" for="firstName">First Name</label>  
                                        <div class="col-md-12">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fa fa-user"></i>
                                                </span>
                                            	<input readonly id="firstName" name="firstName" type="text" value="{{session()->get('currentUser')->getFirstName()}}" placeholder="First Name" class="form-control input-md">
                                        	</div>
                        				</div>
                        			</div>
                        		</td>
                    		</tr>
                    		<tr>
                            	<td>
                        			<!--Last Name -->
                                    <div class="form-group">
                                        <label class="col-md-8 control-label" for="lastName">Last Name</label>  
                                        <div class="col-md-12">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fa fa-user"></i>
                                                </span>
                                            	<input readonly id="lastName" name="lastName" type="text" value="{{session()->get('currentUser')->getLastName()}}" placeholder="Last Name" class="form-control input-md">
                                        	</div>
                        				</div>
                        			</div>
                        		</td>
                    		</tr>
                    		<tr>
                            	<td>
                        			<!--Phone Number -->
                                    <div class="form-group">
                                        <label class="col-md-8 control-label" for="phoneNumber">Phone number </label>  
                                            <div class="col-md-12">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                    	<i class="fa fa-phone"></i>
                                                	</span>
                                                <input readonly id="phoneNumber" name="phoneNumber" type="text" value="{{session()->get('currentUser')->getPhoneNumber()}}" placeholder="Phone number" class="form-control input-md">
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                            	<td>
                                    <!--Email -->
                                    <div class="form-group">
                                        <label class="col-md-8 control-label" for="email">Email Address</label>  
                                        <div class="col-md-12">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                	<i class="fa fa-envelope-o"></i>
                                        		</span>
                                        		<input readonly id="email" name="email" type="text" value="{{session()->get('currentUser')->getEmail()}}" placeholder="Email Address" class="form-control input-md">
                                        	</div>
                                        </div>
                                    </div>
                        		</td>
                    		</tr>
                    		<tr>
                            	<td>
                                    <!-- User Name -->
                                    <div class="form-group">
                                        <label class="col-md-8 control-label" for="userName">User Name</label>  
                                        <div class="col-md-12">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fa fa-user"></i>
                                                </span>
                                            	<input readonly id="userName" name="userName" type="text" value="{{session()->get('currentUser')->getUserCredential()->getUserName()}}" placeholder="User Name" class="form-control input-md">
                                        	</div>
                        				</div>
                        			</div>
                        		</td>
                    		</tr>
                    		<tr>
                            	<td>
                        			<!-- password -->
                                    <div class="form-group">
                                        <label class="col-md-8 control-label" for="password">Password</label>  
                                        <div class="col-md-12">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fa fa-key"></i>
                                                </span>
                                            	<input readonly id="password" name="password" type="password" value="{{session()->get('currentUser')->getUserCredential()->getPassword()}}" placeholder="Password" class="form-control input-md">
                                        	</div>
                        				</div>
                        			</div>
                        		</td>
                    		</tr>
                    		<tr>
                	    		<td>
                        			<div class="form-group">
                                        <label class="col-md-8 control-label" for="bio">Overview (max 200 words)</label>
                                        <div class="col-md-12">                     
                                        	<textarea readonly class="form-control" rows="10" id="bio" name="bio">{{session()->get('currentUser')->getUserInformation()->getBio()}}</textarea>
                                        </div>
                                    </div>
                        		</td>
                    		</tr>
                    		<tr align="center">
                    			<td style="display: inline">
                    				<input type= "submit" value= "Edit" onclick="openEditUserInfoForm('{{session()->get('currentUser')->getIdNum()}}', '{{session()->get('currentUser')->getFirstName()}}', '{{session()->get('currentUser')->getLastName()}}', '{{session()->get('currentUser')->getPhoneNumber()}}', '{{session()->get('currentUser')->getEmail()}}', '{{session()->get('currentUser')->getUserCredential()->getUserName()}}', '{{session()->get('currentUser')->getUserCredential()->getPassword()}}', '{{session()->get('currentUser')->getUserInformation()->getBio()}}')" class="btn btn-primary">
                    				<input type= "submit" value= "Delete" class="btn btn-secondary">
                    			</td>
                			</tr>
                		</table>
            		</td>
<!--             		User Education History -->
            		<td style="border-right: 1px solid #c2c2c2" valign="top">
            			@foreach(session()->get('currentUser')->getUserInformation()->getEducationHistory() as $num => $education)
            			@if($education->getEdit())
            			<form method="POST" action="editEducation">
            			@endif
            			<table style="text-align: left; width: 100%">
            				<tr>
                        		<td>
                        			<div class="form-group">
                                        <label class="col-md-8 control-label" for="schoolName">School Name</label>  
                                        <div class="col-md-12">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fa fa-graduation-cap"></i>
                                                </span>
                                                @if($education->getEdit())
                                                	<input id="schoolName" name="schoolName" type="text" value="{{$education->getName()}}" placeholder="School Name" class="form-control input-md">
                                                @else
                                            		<input readonly id="schoolName" name="schoolName" type="text" value="{{$education->getName()}}" placeholder="School Name" class="form-control input-md">
                                        		@endif
                                        	</div>
                        				</div>
                        			</div>	
                        		</td>
                    		</tr>
                    		<tr>
                        		<td>
                        			<div class="form-group">
                                        <label class="col-md-8 control-label" for="degree">Degree</label>  
                                        <div class="col-md-12">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fa fa-graduation-cap"></i>
                                                </span>
                                                @if($education->getEdit())
                                                	<input id="degree" name="degree" type="text" value="{{$education->getDegree()}}" placeholder="Degree of Study" class="form-control input-md">	
                                                @else
                                            		<input readonly id="degree" name="degree" type="text" value="{{$education->getDegree()}}" placeholder="Degree of Study" class="form-control input-md">
                                        		@endif
                                        	</div>
                        				</div>
                        			</div>	
                        		</td>
                    		</tr>
                    		<tr>
                        		<td>
                        			<div class="form-group">
                                        <label class="col-md-8 control-label" for="field">Field of Study</label>  
                                        <div class="col-md-12">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fa fa-graduation-cap"></i>
                                                </span>
                                                @if($education->getEdit())
                                                	<input id="field" name="field" type="text" value="{{$education->getField()}}" placeholder="Field of Study" class="form-control input-md">	
                                                @else
                                            		<input readonly id="field" name="field" type="text" value="{{$education->getField()}}" placeholder="Field of Study" class="form-control input-md">
                                        		@endif
                                        	</div>
                        				</div>
                        			</div>
                        		</td>
                    		</tr>
                    		<tr>
                        		<td>
                        			<div class="form-group">
                                        <label class="col-md-8 control-label" for="educationStartDate">Start Date</label>  
                                        <div class="col-md-12">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fa fa-clock-o"></i>
                                                </span>
                                                @if($education->getEdit())
                                                	<input id="educationStartDate" name="educationStartDate" type="date" value="{{$education->getStartDate()}}" placeholder="Start Date" class="form-control input-md">
                                                @else
                                            		<input readonly id="educationStartDate" name="educationStartDate" type="date" value="{{$education->getStartDate()}}" placeholder="Start Date" class="form-control input-md">
                                        		@endif
                                        	</div>
                        				</div>
                        			</div>
                        		</td>
                    		</tr>
                    		<tr>
                        		<td>
                        			<div class="form-group">
                                        <label class="col-md-8 control-label" for="educationEndDate">End Date</label>  
                                        <div class="col-md-12">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fa fa-clock-o"></i>
                                                </span>
                                                @if($education->getEdit())
                                                <input id="educationEndDate" name="educationEndDate" type="date" value="{{$education->getEndDate()}}" placeholder="End Date" class="form-control input-md">	
                                                @else
                                            	<input readonly id="educationEndDate" name="educationEndDate" type="date" value="{{$education->getEndDate()}}" placeholder="End Date" class="form-control input-md">
                                        		@endif
                                        	</div>
                        				</div>
                        			</div>
                        		</td>
                    		</tr>
                    		<tr>
                        		<td>
                        			<div class="form-group">
                                        <label class="col-md-8 control-label" for="educationDescription">Description (max 200 words)</label>
                                        <div class="col-md-12">
                                        @if($education->getEdit())
                                             <textarea class="form-control" rows="10"  id="educationDescription" name="educationDescription">{{$education->getDescription()}}</textarea>   	
                                        @else                     
                                        	<textarea readonly class="form-control" rows="10"  id="educationDescription" name="educationDescription">{{$education->getDescription()}}</textarea>
                                        @endif
                                        </div>
                                    </div>
                        		</td>
                    		</tr>
                    		<tr align="center">
                    			<td style="display: inline">
                    				@if($education->getEdit())
                    					<input type="hidden" name ="_token" value="<?php echo csrf_token()?>"/>
                    					<input type="hidden" name="educationId" value="{{$education->getId()}}">
                    					<input type= "submit" value= "Save Changes" class="btn btn-success">	
                    				@else
                    				<form method="POST" action="openEducationEdit" style="display: inline">
                    					<input type="hidden" name ="_token" value="<?php echo csrf_token()?>"/>
                    					<input type="hidden" name="educationNum" value="{{$num}}">
                    					<input type= "submit" value= "Edit" class="btn btn-primary">	
                    				</form>
                    				<form method="POST" action="deleteEducation" style="display: inline" onsubmit="return confirm('Are you sure you want to delete this Education?')">
                    					<input type="hidden" name ="_token" value="<?php echo csrf_token()?>"/>
                    					<input type="hidden" name="educationId" value="{{$education->getId()}}">
                    					<input type= "submit" value= "Delete" class="btn btn-secondary">
                    				</form>
                    				@endif
                    			</td>
                			</tr>
                		</table>
                		@if($education->getEdit())
            			</form>
            			@endif
            			@endforeach
        				<br>
        				<hr>
        				<input type= "submit" value= "Add" class="btn btn-primary" onclick="openEducationForm()">
            		</td>
<!--             		User Job History -->
            		<td style="border-right: 1px solid #c2c2c2" valign="top">
            		@foreach(session()->get('currentUser')->getUserInformation()->getJobs() as $num => $job)
            			@if($job->getEdit())
            			<form method="POST" action="editJob">
            			@endif
            			<table style="text-align: left; width: 100%">
                		<tr>
                    		<td>
                    			<div class="form-group">
                                    <label class="col-md-8 control-label" for="jobTitle">Title</label>  
                                    <div class="col-md-12">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fa fa-briefcase"></i>
                                            </span>
                                            @if($job->getEdit())
                                            	<input id="jobTitle" name="jobTitle" type="text" value="{{$job->getTitle()}}" placeholder="Job Title" class="form-control input-md">
                                        	@else
                                        	<input readonly id="jobTitle" name="jobTitle" type="text" value="{{$job->getTitle()}}" placeholder="Job Title" class="form-control input-md">
                                    		@endif
                                    	</div>
                    				</div>
                    			</div>	
                    		</td>
                		</tr>
                    		<tr>
                    		<td>
                    			<div class="form-group">
                                    <label class="col-md-8 control-label" for="companyName">Company Name</label>  
                                    <div class="col-md-12">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fa fa-briefcase"></i>
                                            </span>
                                            @if($job->getEdit())
                                            <input id="companyName" name="companyName" type="text" value="{{$job->getCompanyName()}}" placeholder="CompanyName" class="form-control input-md">
                                        	@else
                                        	<input readonly id="companyName" name="companyName" type="text" value="{{$job->getCompanyName()}}" placeholder="CompanyName" class="form-control input-md">
                                        	@endif
                                    	</div>
                    				</div>
                    			</div>
                    		</td>
                		</tr>
                		<tr>
                    		<td>
                    			<div class="form-group">
                                    <label class="col-md-8 control-label" for="jobStartDate">Start Date</label>  
                                    <div class="col-md-12">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fa fa-clock-o"></i>
                                            </span>
                                            @if($job->getEdit())
                                            <input id="jobStartDate" name="jobStartDate" type="date" value="{{$job->getStartingDate()}}" placeholder="Start Date" class="form-control input-md">
                                        	@else
                                        	<input readonly id="jobStartDate" name="jobStartDate" type="date" value="{{$job->getStartingDate()}}" placeholder="Start Date" class="form-control input-md">
                                        	@endif
                                    	</div>
                    				</div>
                    			</div>
                    		</td>
                		</tr>
                		<tr>
                    		<td>
                    			<div class="form-group">
                                    <label class="col-md-8 control-label" for="jobEndDate">End Date</label>  
                                    <div class="col-md-12">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fa fa-clock-o"></i>
                                            </span>
                                            @if($job->getEdit())
                                            	<input id="jobEndDate" name="jobEndDate" type="date" value="{{$job->getEndingDate()}}" placeholder="End Date" class="form-control input-md">
                                        	@else
                                        		<input readonly id="jobEndDate" name="jobEndDate" type="date" value="{{$job->getEndingDate()}}" placeholder="End Date" class="form-control input-md">
                                        	@endif
                                    	</div>
                    				</div>
                    			</div>
                    		</td>
                		</tr>
                		<tr>
                    		<td>
                    			<div class="form-group">
                                    <label class="col-md-8 control-label" for="jobDescription">Description (max 200 words)</label>
                                    <div class="col-md-12"> 
                                		@if($job->getEdit())
                                        	<textarea class="form-control" rows="10"  id="jobDescription" name="jobDescription">{{$job->getDescription()}}</textarea>
                                    	@else                    
                                    	<textarea readonly class="form-control" rows="10"  id="jobDescription" name="jobDescription">{{$job->getDescription()}}</textarea>
                                    	@endif
                                    </div>
                                </div>
                    		</td>
                		</tr>
                			<tr align="center">
                    			<td style="display: inline">
                    				@if($job->getEdit())
                    					<input type="hidden" name ="_token" value="<?php echo csrf_token()?>"/>
                    					<input type="hidden" name="jobId" value="{{$job->getId()}}">
                    					<input type= "submit" value= "Save Changes" class="btn btn-success">
                    				@else
                        				<form method="POST" action="openJobEdit" style="display: inline">
                        					<input type="hidden" name ="_token" value="<?php echo csrf_token()?>"/>
                        					<input type="hidden" name="jobNum" value="{{$num}}">
                        					<input type= "submit" value= "Edit" class="btn btn-primary">	
                        				</form>
                        				<form method="POST" action="deleteJob" style="display: inline" onsubmit="return confirm('Are you sure you want to delete this Job?')">
                        					<input type="hidden" name ="_token" value="<?php echo csrf_token()?>"/>
                        					<input type="hidden" name="jobId" value="{{$job->getId()}}">
                        					<input type= "submit" value= "Delete" class="btn btn-secondary">
                        				</form>
                    				@endif
                    			</td>
                			</tr>
                		</table>
                		@if($job->getEdit())
            			</form>
            			@endif
            			@endforeach
        				<br>
        				<hr>
        				<input type= "submit" value= "Add" class="btn btn-primary" onclick="openJobForm()">
            		</td>
<!--             		User Skills -->
            		<td style="border-right: 1px solid #c2c2c2; align: center;" valign="top">
            			<div>
            			<table class="table table-striped table-hover" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Skill</th>
            						<th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            	@foreach(session()->get('currentUser')->getUserInformation()->getSkills() as $skill)
                            	<tr style="text-align: center">
                            		<td>{{$skill->getSkillString()}}</td>
                            		<td>
                						<button onclick="openEditSkillForm({{$skill->getId()}}, '{{$skill->getSkillString()}}')" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xe150;</i></button>
                						<form method= "POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this skill?')">
                							<input type="hidden" name ="_token" value="<?php echo csrf_token()?>"/>
                							<input type="hidden" name="skillId" value="{{$skill->getId()}}">
                							<button formaction="deleteSkill" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE5C9;</i></button>
                						</form>	
            						</td>
                        		</tr>
                        		@endforeach
                        	</tbody>
                        </table>
                        </div>
                        <hr>
        				<input type= "submit" value= "Add" class="btn btn-primary" onclick="openSkillForm()">
            		</td>
            	</tr>
            </table>
        </div>
    </div>
    
    
    <div id="addEducationForm">	
    	<h2>Add Education</h2>
        <form method= "POST" action= "addEducation">
        	<input type="hidden" name ="_token" value="<?php echo csrf_token()?>"/>
        	<table style="width: 100%">
        	<tr>
        		<td>
        			<div class="form-group">
                        <label class="col-md-13 control-label" for="schoolName">School Name</label>  
                        <div class="col-md-13">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-graduation-cap"></i>
                                </span>
                            	<input id="schoolName" name="schoolName" type="text" placeholder="School Name" class="form-control input-md">
                        	</div>
        				</div>
        			</div>	
        		</td>
    		</tr>
    		<tr>
        		<td>
        			<div class="form-group">
                        <label class="col-md-13 control-label" for="degree">Degree</label>  
                        <div class="col-md-13">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-graduation-cap"></i>
                                </span>
                            	<input id="degree" name="degree" type="text" placeholder="Degree of Study" class="form-control input-md">
                        	</div>
        				</div>
        			</div>	
        		</td>
    		</tr>
    		<tr>
        		<td>
        			<div class="form-group">
                        <label class="col-md-13 control-label" for="field">Field of Study</label>  
                        <div class="col-md-13">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-graduation-cap"></i>
                                </span>
                            	<input id="field" name="field" type="text" placeholder="Field of Study" class="form-control input-md">
                        	</div>
        				</div>
        			</div>
        		</td>
    		</tr>
    		<tr>
        		<td>
        			<div class="form-group">
                        <label class="col-md-13 control-label" for="educationStartDate">Start Date</label>  
                        <div class="col-md-13">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-clock-o"></i>
                                </span>
                            	<input id="educationStartDate" name="educationStartDate" type="date" placeholder="Start Date" class="form-control input-md">
                        	</div>
        				</div>
        			</div>
        		</td>
    		</tr>
    		<tr>
        		<td>
        			<div class="form-group">
                        <label class="col-md-13 control-label" for="educationEndDate">End Date</label>  
                        <div class="col-md-13">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-clock-o"></i>
                                </span>
                            	<input id="educationEndDate" name="educationEndDate" type="date" placeholder="End Date" class="form-control input-md">
                        	</div>
        				</div>
        			</div>
        		</td>
    		</tr>
    		<tr>
        		<td>
        			<div class="form-group">
                        <label class="col-md-13 control-label" for="educationDescription">Description (max 200 words)</label>
                        <div class="col-md-13">                     
                        	<textarea class="form-control" rows="2" id="educationDescription" name="educationDescription"></textarea>
                        </div>
                    </div>
        		</td>
    		</tr>
    		<tr align="center" style="width: 100%;">
    			<td>
    				<input type= "submit" value= "Add Education" class="btn btn-primary">
    			</td>
    		</tr>
        	</table>
        </form>
    </div>
    
    <div id="addJobForm">	
    	<h2>Add Job</h2>
        <form method= "POST" action= "addJob">
        	<input type="hidden" name ="_token" value="<?php echo csrf_token()?>"/>
        	<table style="width: 100%">
        		<tr>
            		<td>
            			<div class="form-group">
                            <label class="col-md-13 control-label" for="jobTitle">Title</label>  
                            <div class="col-md-13">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-briefcase"></i>
                                    </span>
                                	<input id="jobTitle" name="jobTitle" type="text" placeholder="Job Title" class="form-control input-md">
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
                                	<input id="companyName" name="companyName" type="text" placeholder="CompanyName" class="form-control input-md">
                            	</div>
            				</div>
            			</div>
            		</td>
        		</tr>
        		<tr>
            		<td>
            			<div class="form-group">
                            <label class="col-md-13 control-label" for="jobStartDate">Start Date</label>  
                            <div class="col-md-13">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-clock-o"></i>
                                    </span>
                                	<input id="jobStartDate" name="jobStartDate" type="date" placeholder="Start Date" class="form-control input-md">
                            	</div>
            				</div>
            			</div>
            		</td>
        		</tr>
        		<tr>
            		<td>
            			<div class="form-group">
                            <label class="col-md-13 control-label" for="jobEndDate">End Date</label>  
                            <div class="col-md-13">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-clock-o"></i>
                                    </span>
                                	<input id="jobEndDate" name="jobEndDate" type="date" placeholder="End Date" class="form-control input-md">
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
        				<input type= "submit" value= "Add Job" class="btn btn-primary">
        			</td>
        		</tr>
        	</table>
        </form>
    </div>
    
    <div id="addSkillForm">	
    	<h2>Add Skill</h2>
        <form method= "POST" action= "addSkill">
        	<input type="hidden" name ="_token" value="<?php echo csrf_token()?>"/>
        	<table style="width: 100%">
        	<tr>
        		<td>
        			<div class="form-group">
                        <label class="col-md-13 control-label" for="skillString">Skill</label>  
                        <div class="col-md-13">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-bullseye"></i>
                                </span>
                            	<input id="skillString" name="skillString" type="text" placeholder="Skill" class="form-control input-md">
                        	</div>
        				</div>
        			</div>	
        		</td>
    		</tr>
        	<tr align="center" style="width: 100%;">
        			<td>
        				<input type= "submit" value= "Add Skill" class="btn btn-primary">
        			</td>
        		</tr>
        	</table>
        </form>
    </div>
    
    <div id="editSkillForm">	
    	<h2>Edit Skill</h2>
        <form method= "POST" action= "editSkill">
        	<input type="hidden" name ="_token" value="<?php echo csrf_token()?>"/>
        	<input type="hidden" id="editSkillId" name="skillId" value="-1">
        	<table style="width: 100%">
        	<tr>
        		<td>
        			<div class="form-group">
                        <label class="col-md-13 control-label" for="skillString">Skill</label>  
                        <div class="col-md-13">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-bullseye"></i>
                                </span>
                            	<input id="editSkillString" name="editSkillString" type="text" placeholder="Skill" class="form-control input-md">
                        	</div>
        				</div>
        			</div>	
        		</td>
    		</tr>
        	<tr align="center" style="width: 100%;">
        			<td>
        				<input type= "submit" value= "Edit Skill" class="btn btn-primary">
        			</td>
        		</tr>
        	</table>
        </form>
    </div>
    
    <div id="editUserInfo">
    	<h2>Edit User Info</h2>
    	<form method="POST" action="editUser">
    	<input type="hidden" name ="_token" value="<?php echo csrf_token()?>"/>
        <input type="hidden" id="editUserId" name="userId" value="-1">
    	<table style="text-align: left; width: 100%">
            <tr>
            	<td>
                   <!-- Firstname Name -->
                    <div class="form-group">
                        <label class="col-md-8 control-label" for="firstName">First Name</label>  
                        <div class="col-md-12">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-user"></i>
                                </span>
                            	<input id="editFirstName" name="firstName" type="text" placeholder="First Name" class="form-control input-md">
                        	</div>
        				</div>
        			</div>
        		</td>
    		</tr>
    		<tr>
            	<td>
        			<!--Last Name -->
                    <div class="form-group">
                        <label class="col-md-8 control-label" for="lastName">Last Name</label>  
                        <div class="col-md-12">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-user"></i>
                                </span>
                            	<input id="editLastName" name="lastName" type="text" placeholder="Last Name" class="form-control input-md">
                        	</div>
        				</div>
        			</div>
        		</td>
    		</tr>
    		<tr>
            	<td>
        			<!--Phone Number -->
                    <div class="form-group">
                        <label class="col-md-8 control-label" for="phoneNumber">Phone number </label>  
                            <div class="col-md-12">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                    	<i class="fa fa-phone"></i>
                                	</span>
                                <input id="editPhoneNumber" name="phoneNumber" type="text" placeholder="Phone number" class="form-control input-md">
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
            	<td>
                    <!--Email -->
                    <div class="form-group">
                        <label class="col-md-8 control-label" for="email">Email Address</label>  
                        <div class="col-md-12">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                	<i class="fa fa-envelope-o"></i>
                        		</span>
                        		<input id="editEmail" name="email" type="text" placeholder="Email Address" class="form-control input-md">
                        	</div>
                        </div>
                    </div>
        		</td>
    		</tr>
    		<tr>
            	<td>
                    <!-- User Name -->
                    <div class="form-group">
                        <label class="col-md-8 control-label" for="userName">User Name</label>  
                        <div class="col-md-12">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-user"></i>
                                </span>
                            	<input id="editUserName" name="userName" type="text" placeholder="User Name" class="form-control input-md">
                        	</div>
        				</div>
        			</div>
        		</td>
    		</tr>
    		<tr>
            	<td>
        			<!-- password -->
                    <div class="form-group">
                        <label class="col-md-8 control-label" for="password">Password</label>  
                        <div class="col-md-12">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-key"></i>
                                </span>
                            	<input id="editPassword" name="password" type="password" placeholder="Password" class="form-control input-md">
                        	</div>
        				</div>
        			</div>
        		</td>
    		</tr>
    		<tr>
        		<td>
        			<div class="form-group">
                        <label class="col-md-8 control-label" for="bio">Overview (max 200 words)</label>
                        <div class="col-md-12">                     
                        	<textarea class="form-control" rows="2" id="editBio" name="bio"></textarea>
                        </div>
                    </div>
        		</td>
    		</tr>
    		<tr align="center">
    			<td >
    				<input type= "submit" value= "Edit User" class="btn btn-primary">
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