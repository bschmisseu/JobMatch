<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/registration', function () {
    return view('registration');
});

Route::get('/home', function () {
    return view('homePage');
});

Route::post('/loginUser', 'UserController@authenticateUser');

Route::post('/registerUser', 'UserController@registerUser');

Route::post('/editUser', 'UserController@editUser');

Route::get('/logout', 'UserController@logout');

Route::get('/admin', 'AdminController@adminPage');

Route::post('/deleteUser', 'AdminController@deleteUser');

Route::post('/suspendUser', 'AdminController@suspendUser');

Route::get('/profile', function() {
    return view('profile');
});

Route::post('/adminViewUser', 'AdminController@viewUser');

Route::post('/editUser', 'UserController@editUser');

Route::post('/addEducation', 'UserController@addEducation');

Route::post('/addJob', 'UserController@addJob');

Route::post('/addSkill', 'UserController@addSkill');

Route::post('/deleteEducation', 'UserController@deleteEducation');

Route::post('/deleteJob', 'UserController@deleteJob');

Route::post('/deleteSkill', 'UserController@deleteSkill');

Route::post('/openEducationEdit', 'UserController@openEducationEdit');

Route::post('/editEducation', 'UserController@editEducation');

Route::post('/openJobEdit', 'UserController@openJobEdit');

Route::post('/editJob', 'UserController@editJob');

Route::post('/editSkill', 'UserController@editSkill');

Route::post('/addJobListing', 'AdminController@addJobListing');

Route::post('/deleteJobListing', 'AdminController@deleteJobListing');

Route::post('/editJobListing', 'AdminController@editJobListing');

Route::get('/groups', 'GroupController@groupListPage');

Route::post('/addGroup', 'GroupController@addGroup');

Route::post('/editGroup', 'GroupController@editGroup');

Route::post('/deleteGroup', 'GroupController@deleteGroup');

Route::post('/joinGroup', 'GroupController@joinGroup');

Route::post('/leaveGroup', 'GroupController@leaveGroup');

Route::get('/jobListings', 'JobListingController@jobListingPage');

Route::post('/applyJobListing', 'JobListingController@applyJobListing');

Route::post('/searchJobListing', 'JobListingController@searchJobListing');

Route::resource('/usersrest', 'UsersRestController');

Route::resource('/jobsrest', 'JobsRestController');
   