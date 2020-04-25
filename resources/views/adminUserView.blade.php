@extends('layouts.appmaster')
@section('title', 'Job Match: Admin User View')

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
                                            	<input readonly id="firstName" name="firstName" type="text" value="{{$currentUser->getFirstName()}}" placeholder="First Name" class="form-control input-md">
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
                                            	<input readonly id="lastName" name="lastName" type="text" value="{{$currentUser->getLastName()}}" placeholder="Last Name" class="form-control input-md">
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
                                                <input readonly id="phoneNumber" name="phoneNumber" type="text" value="{{$currentUser->getPhoneNumber()}}" placeholder="Phone number" class="form-control input-md">
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
                                        		<input readonly id="email" name="email" type="text" value="{{$currentUser->getEmail()}}" placeholder="Email Address" class="form-control input-md">
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
                                            	<input readonly id="userName" name="userName" type="text" value="{{$currentUser->getUserCredential()->getUserName()}}" placeholder="User Name" class="form-control input-md">
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
                                            	<input readonly id="password" name="password" type="password" value="{{$currentUser->getUserCredential()->getPassword()}}" placeholder="Password" class="form-control input-md">
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
                                        	<textarea readonly class="form-control" rows="10" id="bio" name="bio">{{$currentUser->getUserInformation()->getBio()}}</textarea>
                                        </div>
                                    </div>
                        		</td>
                    		</tr>
                		</table>
            		</td>
<!--             		User Education History -->
            		<td style="border-right: 1px solid #c2c2c2" valign="top">
            			@foreach($currentUser->getUserInformation()->getEducationHistory() as $num => $education)
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
                                                <input readonly id="schoolName" name="schoolName" type="text" value="{{$education->getName()}}" placeholder="School Name" class="form-control input-md">
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
                                            	<input readonly id="degree" name="degree" type="text" value="{{$education->getDegree()}}" placeholder="Degree of Study" class="form-control input-md">
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
                                            	<input readonly id="field" name="field" type="text" value="{{$education->getField()}}" placeholder="Field of Study" class="form-control input-md">
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
                                            	<input readonly id="educationStartDate" name="educationStartDate" type="date" value="{{$education->getStartDate()}}" placeholder="Start Date" class="form-control input-md">
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
                                            	<input readonly id="educationEndDate" name="educationEndDate" type="date" value="{{$education->getEndDate()}}" placeholder="End Date" class="form-control input-md">
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
                                        	<textarea readonly class="form-control" rows="10"  id="educationDescription" name="educationDescription">{{$education->getDescription()}}</textarea>
                                        </div>
                                    </div>
                        		</td>
                    		</tr>
                		</table>
            			@endforeach
        				<br>
        				<hr>
            		</td>
<!--             		User Job History -->
            		<td style="border-right: 1px solid #c2c2c2" valign="top">
            		@foreach($currentUser->getUserInformation()->getJobs() as $num => $job)
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
                                        	<input readonly id="jobTitle" name="jobTitle" type="text" value="{{$job->getTitle()}}" placeholder="Job Title" class="form-control input-md">
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
                                        	<input readonly id="companyName" name="companyName" type="text" value="{{$job->getCompanyName()}}" placeholder="CompanyName" class="form-control input-md">
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
                                        	<input readonly id="jobStartDate" name="jobStartDate" type="date" value="{{$job->getStartingDate()}}" placeholder="Start Date" class="form-control input-md">
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
                                        	<input readonly id="jobEndDate" name="jobEndDate" type="date" value="{{$job->getEndingDate()}}" placeholder="End Date" class="form-control input-md">
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
                                    	<textarea readonly class="form-control" rows="10"  id="jobDescription" name="jobDescription">{{$job->getDescription()}}</textarea>
                                    </div>
                                </div>
                    		</td>
                		</tr>
                		</table>
            			@endforeach
        				<br>
        				<hr>
            		</td>
<!--             		User Skills -->
            		<td style="border-right: 1px solid #c2c2c2; align: center;" valign="top">
            			<div>
            			<table class="table table-striped table-hover" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Skill</th>
                                </tr>
                            </thead>
                            <tbody>
                            	@foreach($currentUser->getUserInformation()->getSkills() as $skill)
                            	<tr style="text-align: center">
                            		<td>{{$skill->getSkillString()}}</td>
                        		</tr>
                        		@endforeach
                        	</tbody>
                        </table>
                        </div>
                        <hr>
            		</td>
            	</tr>
            </table>
        </div>
    </div> 
@endsection