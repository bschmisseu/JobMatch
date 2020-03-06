@extends('layouts.appmaster')
@section('title', 'Job Match: Index')

@section('content')
<div align="center">
    <h2>Job Match</h2><br/>
    
    <div align="center">
        <table style="padding: 10px;">
        	<tr>
        		<td align="center">
        			<form method= "GET" action= "login">
        				<input type= "submit" value= "Login" class="btn btn-primary">
        			</form>
        		</td>
        	</tr>
        	<tr>
        		<td align="center">
        			<form method= "GET" action= "registration">
        				<input type= "submit" value= "Registration" class="btn btn-primary">
        			</form>
        		</td>
        	</tr>
    	</table><br/>
	</div>

Please select Login or Register to Continue!
</div>
@endsection