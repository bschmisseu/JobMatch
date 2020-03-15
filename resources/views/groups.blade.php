@extends('layouts.appmaster')
@section('title', 'Job Match: Groups')

@section('content')
<link rel="stylesheet" href="resources/style/adminPage.css">
<link rel="stylesheet" href="resources/style/popup_style.css">
<script src="resources/js/popup_script.js"></script>
	
	<div class="container" style="font-size: 13px">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-5">
						<h2>Affinity <b>Groups</b></h2>
					</div>
					<div class="col-sm-7">
						<a onclick="openGroupForm()" class="btn btn-primary"><i class="material-icons">&#xE147;</i> <span>Add New Group</span></a>					
					</div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Group Name</th>						
						<th>Owner</th>
						<th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($groups as $group)
                <tr style="text-align: center">
               		<td>{{$group->getId()}}</td>
               		<td>{{$group->getName()}}</td>
               		<td>{{$group->getOwnerName()}}</td>
               		<td>
               			@if(session()->get('currentUser')->getIdNum() == $group->getUserId())
    					<button onclick="openEditGroupForm({{$group->getId()}}, '{{$group->getName()}}')" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xe150;</i></button>
    					<form method= "POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this group')">
    						<input type="hidden" name ="_token" value="<?php echo csrf_token()?>"/>
    						<input type="hidden" name="groupId" value="{{$group->getId()}}">
    						<button formaction="deleteGroup" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE5C9;</i></button>
    					</form>
    					@elseif($group->isApart(session()->get('currentUser')->getIdNum()))
    						<form method= "POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to leave this group?')">
        						<input type="hidden" name ="_token" value="<?php echo csrf_token()?>"/>
        						<input type="hidden" name="groupId" value="{{$group->getId()}}">
        						<button formaction="leaveGroup" class="leave" title="leave" data-toggle="tooltip"><i class="material-icons">&#xe14c;</i></button>
        					</form>
    					@else
    						<form method= "POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to join this group?')">
        						<input type="hidden" name ="_token" value="<?php echo csrf_token()?>"/>
        						<input type="hidden" name="groupId" value="{{$group->getId()}}">
        						<button formaction="joinGroup" class="join" title="join" data-toggle="tooltip"><i class="material-icons">&#xe5ca;</i></button>
        					</form>
    					@endif	
    				</td>
       			</tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    <div id="addGroupForm">	
    	<h2>Add Skill</h2>
        <form method= "POST" action= "addGroup">
        	<input type="hidden" name ="_token" value="<?php echo csrf_token()?>"/>
        	<table style="width: 100%">
        	<tr>
        		<td>
        			<div class="form-group">
                        <label class="col-md-13 control-label" for="groupName">Group Name</label>  
                        <div class="col-md-13">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-users"></i>
                                </span>
                            	<input id="groupName" name="groupName" type="text" placeholder="Name" class="form-control input-md">
                        	</div>
        				</div>
        			</div>	
        		</td>
    		</tr>
        		<tr align="center" style="width: 100%;">
        			<td>
        				<input type= "submit" value= "Add Group" class="btn btn-primary">
        			</td>
        		</tr>
        	</table>
        </form>
    </div>
    
    <div id="editGroupForm">	
    	<h2>Edit Skill</h2>
        <form method= "POST" action= "editGroup">
        	<input type="hidden" name ="_token" value="<?php echo csrf_token()?>"/>
        	<input type="hidden" id="editGroupId" name="editGroupId" value="-1">
        	<table style="width: 100%">
        	<tr>
        		<td>
        			<div class="form-group">
                        <label class="col-md-13 control-label" for="editGroupName">Group Name</label>  
                        <div class="col-md-13">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-users"></i>
                                </span>
                            	<input id="editGroupName" name="editGroupName" type="text" placeholder="Name" class="form-control input-md">
                        	</div>
        				</div>
        			</div>	
        		</td>
    		</tr>
        		<tr align="center" style="width: 100%;">
        			<td>
        				<input type= "submit" value= "Edit Group" class="btn btn-primary">
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