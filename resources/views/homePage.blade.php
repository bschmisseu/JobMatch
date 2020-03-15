@extends('layouts.appmaster')
@section('title', 'Job Match: Home Page')

@section('content')
<div align="center">
    <h2>Home Page</h2><br/>
    	@if(isset($returnMessage))
    		<h4> {{$returnMessage}}</h4>
		@endif
		@if(isset($returnApplyJob))
    		<script>
				alert("Applied to Job Successful!");
			</script>
		@endif
</div>
@endsection