@if(session()->has('currentUser'))
	@if(session()->get('currentUser')->getUserRole() == 0)
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="home">Job Match</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            	<span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                    	<a class="nav-link" href="profile">Profile <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                    	<a class="nav-link" href="jobListings">Job Listings <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                    	<a class="nav-link" href="groups">Groups <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                    	<a class="nav-link" href="admin">Admin<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                    	<a class="nav-link" href="logout">Logout <span class="sr-only">(current)</span></a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0" method="post" action="searchJobListing">
                	<input type="hidden" name ="_token" value="<?php echo csrf_token()?>"/>
                    <input class="form-control mr-sm-2" type="search" name="searchParam" placeholder="Search">
                    <button class="btn btn-primary my-2 my-sm-0" style="color: white !important" type="submit">Search</button>
                </form>
            </div>
        </nav>
	@else
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="home">Job Match</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            	<span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                    	<a class="nav-link" href="profile">Profile <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                    	<a class="nav-link" href="#">Job Listings <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                    	<a class="nav-link" href="#">Groups <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                    	<a class="nav-link" href="logout">Logout <span class="sr-only">(current)</span></a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search">
                    <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </nav>
    @endif
@else
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="/JobMatchProject">Job Match</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
          <li class="nav-item active">
            <a class="nav-link" href="login">Login <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="registration">Registration <span class="sr-only">(current)</span></a>
          </li>
        </ul>
      </div>
    </nav>
@endif