@extends('layouts.appmaster')
@section('title', 'Job Match: Login Form')

@section('content')
<div align="center">
    <h2>Login Form</h2>
    <form method= "POST" action= "loginUser" class="was-validated">
    <input type="hidden" name ="_token" value="<?php echo csrf_token()?>"/>
    	<table>
    	<tr>
    		<td>   
    			<div class="form-group">
    				<label for="userName">Username: </label>
    				<input type="text" name="userName" class="form-control" placeholder="Enter username" required="required"/>
    				<div class="invalid-feedback">{{ $errors->first('userName')}}</div>
    			</div>
        	</td>
    	</tr>
    	
    	<tr>
    		<td>
    			<div class="form-group">
    				<label for="password">Password: </label>
    				<input type="password" name="password" class="form-control" placeholder="Enter password" required="required"/>
    				<div class="invalid-feedback">{{ $errors->first('password')}}</div>
    			</div>
    		</td>
    	</tr>
    		
    	<tr>
    		<td colspan= "2" align="center">
    		<div align="center">
    		<input type= "submit" value="Login" class="btn btn-primary">
    		</div>
    		</td>
    	</tr>	
    	</table>
    	<br/>
    </form>
   @if(isset($returnMessage))
   		{{$returnMessage}}
	@endif 
</div><br/>
@endsection