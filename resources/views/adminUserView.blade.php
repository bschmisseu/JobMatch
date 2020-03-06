@extends('layouts.appmaster')
@section('title', 'Job Match: Admin User View')

@section('content')
    <div style="font-size: 13px; background: #fff; padding: 20px 25px; margin: 30px 0; border-radius: 3px; box-shadow: 0 1px 1px rgba(0,0,0,.05); width: 70%">
    	<div style="padding-bottom: 15px;background: #299be4;color: #fff;padding: 16px 30px;margin: -20px -25px 10px;border-radius: 3px 3px 0 0;">
        	<h2>Profile</h2>
    	</div>
    	<table style="width: 100%;">
    		<tr>
    		<td>
    			<h4>User Information</h4>
    		</td>
    		</tr>
        	<tr>
        	<td>
                <!-- Firstname Name -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="firstName">First Name</label>  
                    <div class="col-md-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-user"></i>
                            </span>
                        	<input id="firstName" disabled name="firstName" type="text" value="{{$currentUser->getFirstName()}}" placeholder="First Name" class="form-control input-md">
                    	</div>
    				</div>
    			</div>
    		</td>
    		</tr>
    		<tr>
        	<td>
    			<!--Last Name -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="lastName">Last Name</label>  
                    <div class="col-md-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-user"></i>
                            </span>
                        	<input id="lastName" disabled name="lastName" type="text" value="{{$currentUser->getLastName()}}" placeholder="Last Name" class="form-control input-md">
                    	</div>
    				</div>
    			</div>
    		</td>
    		</tr>
    		<tr>
        	<td>
    			<!--Phone Number -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="phoneNumber">Phone number </label>  
                        <div class="col-md-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                	<i class="fa fa-phone"></i>
                            	</span>
                            <input id="phoneNumber" disabled name="phoneNumber" type="text" value="{{$currentUser->getPhoneNumber()}}" placeholder="Phone number" class="form-control input-md">
                        </div>
                    </div>
                </div>
            </td>
            </tr>
            <tr>
        	<td>
                <!--Email -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="email">Email Address</label>  
                    <div class="col-md-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                            	<i class="fa fa-envelope-o"></i>
                    		</span>
                    		<input id="email" disabled name="email" type="text" value="{{$currentUser->getEmail()}}" placeholder="Email Address" class="form-control input-md">
                    	</div>
                    </div>
                </div>
    		</td>
    		</tr>
    		<tr>
        	<td>
                <!-- User Name -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="userName">User Name</label>  
                    <div class="col-md-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-user"></i>
                            </span>
                        	<input id="userName" disabled name="userName" type="text" value="{{$currentUser->getUserCredential()->getUserName()}}" placeholder="User Name" class="form-control input-md">
                    	</div>
    				</div>
    			</div>
    		</td>
    		</tr>
    		<tr>
        	<td>
    			<!-- password -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="password">Password</label>  
                    <div class="col-md-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-key"></i>
                            </span>
                        	<input id="password" disabled name="password" type="password" value="{{$currentUser->getUserCredential()->getPassword()}}" placeholder="Password" class="form-control input-md">
                    	</div>
    				</div>
    			</div>
    		</td>
    		</tr>
    		<tr>
    		<td>
    			<div class="form-group">
                    <label class="col-md-4 control-label" for="bio">Overview (max 200 words)</label>
                    <div class="col-md-4">                     
                    	<textarea class="form-control" disabled rows="10" id="bio" name="bio">{{$currentUser->getUserInformation()->getBio()}}</textarea>
                    </div>
                </div>
    		</td>
    		</tr>
    		<tr>
    		<td>
    			<h4>Education</h4>
    		</td>
    		</tr>
    		<tr>
    		<td>
    			<div class="form-group">
                    <label class="col-md-4 control-label" for="schoolName">School Name</label>  
                    <div class="col-md-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-graduation-cap"></i>
                            </span>
                        	<input id="schoolName" disabled name="schoolName" type="text" value="{{$currentUser->getUserInformation()->getEducationHistory()[0]->getName()}}" placeholder="School Name" class="form-control input-md">
                    	</div>
    				</div>
    			</div>	
    		</td>
    		</tr>
    		<tr>
    		<td>
    			<div class="form-group">
                    <label class="col-md-4 control-label" for="degree">Degree</label>  
                    <div class="col-md-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-graduation-cap"></i>
                            </span>
                        	<input id="degree" disabled name="degree" type="text" value="{{$currentUser->getUserInformation()->getEducationHistory()[0]->getDegree()}}" placeholder="Degree of Study" class="form-control input-md">
                    	</div>
    				</div>
    			</div>	
    		</td>
    		</tr>
    		<tr>
    		<td>
    			<div class="form-group">
                    <label class="col-md-4 control-label" for="field">Field of Study</label>  
                    <div class="col-md-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-graduation-cap"></i>
                            </span>
                        	<input id="field" disabled name="field" type="text" value="{{$currentUser->getUserInformation()->getEducationHistory()[0]->getField()}}" placeholder="Field of Study" class="form-control input-md">
                    	</div>
    				</div>
    			</div>
    		</td>
    		</tr>
    		<tr>
    		<td>
    			<div class="form-group">
                    <label class="col-md-4 control-label" for="educationStartDate">Start Date</label>  
                    <div class="col-md-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-clock-o"></i>
                            </span>
                        	<input id="educationStartDate" disabled name="educationStartDate" type="date" value="{{$currentUser->getUserInformation()->getEducationHistory()[0]->getStartDate()}}" placeholder="Start Date" class="form-control input-md">
                    	</div>
    				</div>
    			</div>
    		</td>
    		</tr>
    		<tr>
    		<td>
    			<div class="form-group">
                    <label class="col-md-4 control-label" for="educationEndDate">End Date</label>  
                    <div class="col-md-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-clock-o"></i>
                            </span>
                        	<input id="educationEndDate" disabled name="educationEndDate" type="date" value="{{$currentUser->getUserInformation()->getEducationHistory()[0]->getEndDate()}}" placeholder="End Date" class="form-control input-md">
                    	</div>
    				</div>
    			</div>
    		</td>
    		</tr>
    		<tr>
    		<td>
    			<div class="form-group">
                    <label class="col-md-4 control-label" for="educationDescription">Description (max 200 words)</label>
                    <div class="col-md-4">                     
                    	<textarea class="form-control" disabled rows="10"  id="educationDescription" name="educationDescription">{{$currentUser->getUserInformation()->getEducationHistory()[0]->getDescription()}}</textarea>
                    </div>
                </div>
    		</td>
    		</tr>
    		<tr>
    		<td>
    			<h4>Job</h4>
    		</td>
    		</tr>
    		<tr>
    		<td>
    			<div class="form-group">
                    <label class="col-md-4 control-label" for="jobTitle">Title</label>  
                    <div class="col-md-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-briefcase"></i>
                            </span>
                        	<input id="jobTitle" disabled name="jobTitle" type="text" value="{{$currentUser->getUserInformation()->getJobs()[0]->getTitle()}}" placeholder="Job Title" class="form-control input-md">
                    	</div>
    				</div>
    			</div>	
    		</td>
    		</tr>
    		<tr>
    		<td>
    			<div class="form-group">
                    <label class="col-md-4 control-label" for="companyName">Company Name</label>  
                    <div class="col-md-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-briefcase"></i>
                            </span>
                        	<input id="companyName" disabled name="companyName" type="text" value="{{$currentUser->getUserInformation()->getJobs()[0]->getCompanyName()}}" placeholder="CompanyName" class="form-control input-md">
                    	</div>
    				</div>
    			</div>
    		</td>
    		</tr>
    		<tr>
    		<td>
    			<div class="form-group">
                    <label class="col-md-4 control-label" for="jobStartDate">Start Date</label>  
                    <div class="col-md-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-clock-o"></i>
                            </span>
                        	<input id="jobStartDate" disabled name="jobStartDate" type="date" value="{{$currentUser->getUserInformation()->getJobs()[0]->getStartingDate()}}" placeholder="Start Date" class="form-control input-md">
                    	</div>
    				</div>
    			</div>
    		</td>
    		</tr>
    		<tr>
    		<td>
    			<div class="form-group">
                    <label class="col-md-4 control-label" for="jobEndDate">End Date</label>  
                    <div class="col-md-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-clock-o"></i>
                            </span>
                        	<input id="jobEndDate" disabled name="jobEndDate" type="date" value="{{$currentUser->getUserInformation()->getJobs()[0]->getEndingDate()}}" placeholder="End Date" class="form-control input-md">
                    	</div>
    				</div>
    			</div>
    		</td>
    		</tr>
    		<tr>
    		<td>
    			<div class="form-group">
                    <label class="col-md-4 control-label" for="jobDescription">Description (max 200 words)</label>
                    <div class="col-md-4">                     
                    	<textarea class="form-control" disabled rows="10"  id="jobDescription" name="jobDescription">{{$currentUser->getUserInformation()->getJobs()[0]->getDescription()}}</textarea>
                    </div>
                </div>
    		</td>
    		</tr>
    		<tr>
    		<td>
    			<input type= "submit" value= "Save Changes" class="btn btn-success">
    		</td>
    		</tr>
		</table>	
    </div>
    <br>
@endsection