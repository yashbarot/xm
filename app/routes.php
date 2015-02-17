<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('homepage');
});
Route::get('simulator/index/{id}', 'SimulatorController@index')->before('isAdmin');
Route::post('simulator/filters', 'SimulatorController@doFiltering');
Route::post('simulator/projects', 'SimulatorController@projects')->before('isAdmin');
Route::post('simulator/scenarios', 'SimulatorController@scenarios')->before('isAdmin');

Route::get('project_master/index', ['as' => 'project_master.index', 'uses' => 'ProjectMastersController@index', 'before' => 'isAdmin']);
Route::get('project_master/create', ['as' => 'project_master.create', 'uses' => 'ProjectMastersController@create', 'before' => 'isAdmin']);
Route::post('project_master/store', ['as' => 'project_master.store', 'uses'  => 'ProjectMastersController@store', 'before' => 'isAdmin']);
Route::get('project_master/new_project_form', ['as' => 'project_master.new_project_form', 'uses' => 'ProjectMastersController@new_project_form', 'before' => 'isAdmin']);
Route::post('project_master/store_new_project_form', ['as' => 'project_master.store_new_project_form', 'uses'  => 'ProjectMastersController@store_new_project_form', 'before' => 'isAdmin']);

// Confide routes
Route::get('users/create', 'UsersController@create');
Route::post('users', 'UsersController@store');
Route::get('users/login', 'UsersController@login');
Route::post('users/login', 'UsersController@doLogin');
Route::get('users/confirm/{code}', 'UsersController@confirm');
Route::get('users/forgot_password', 'UsersController@forgotPassword');
Route::post('users/forgot_password', 'UsersController@doForgotPassword');
Route::get('users/reset_password/{token}', 'UsersController@resetPassword');
Route::post('users/reset_password', 'UsersController@doResetPassword');
Route::get('users/logout', 'UsersController@logout');

// Roles routes 
Route::get('roles/create', ['as' => 'roles.create', 'uses' => 'RolesController@create', 'before' => 'isAdmin']);
Route::post('roles/store', ['as' => 'roles.store', 'uses'  => 'RolesController@store', 'before' => 'isAdmin']);
Route::get('roles/index',  ['as' => 'roles.index', 'uses'  => 'RolesController@index', 'before' => 'isAdmin']);

// Permissions routes
Route::get('permissions/create', ['as' => 'permissions.create', 'uses' => 'PermissionsController@create', 'before' => 'isAdmin']);
Route::post('permissions/store', ['as' => 'permissions.store', 'uses'  => 'PermissionsController@store', 'before' => 'isAdmin']);
Route::get('permissions/index',  ['as' => 'permissions.index', 'uses'  => 'PermissionsController@index', 'before' => 'isAdmin']);

// PermissionRoles routes
Route::get('permissionroles/create', ['as' => 'permissionroles.create', 'uses' => 'PermissionRolesController@create', 'before' => 'isAdmin']);
Route::post('permissionroles/store', ['as' => 'permissionroles.store', 'uses'  => 'PermissionRolesController@store', 'before' => 'isAdmin']);
Route::get('permissionroles/index',  ['as' => 'permissionroles.index', 'uses'  => 'PermissionRolesController@index', 'before' => 'isAdmin']);


// AssignedRoles routes
Route::get('assignedroles/create', ['as' => 'assignedroles.create', 'uses' => 'AssignedRolesController@create', 'before' => 'isAdmin']);
Route::post('assignedroles/store', ['as' => 'assignedroles.store', 'uses'  => 'AssignedRolesController@store', 'before' => 'isAdmin']);
Route::get('assignedroles/index',  ['as' => 'assignedroles.index', 'uses'  => 'AssignedRolesController@index', 'before' => 'isAdmin']);

Route::model('role', 'Role');
Route::get('roles/edit/{role}','RolesController@edit')->before('isAdmin');
Route::post('roles/update', 'RolesController@update')->before('isAdmin');

Route::model('permission', 'Permission');
Route::get('permissions/edit/{permission}','PermissionsController@edit')->before('isAdmin');
Route::post('permissions/update', 'PermissionsController@update')->before('isAdmin');

Route::model('assignedrole', 'AssignedRole');
Route::get('assignedroles/edit/{assignedrole}','AssignedRolesController@edit')->before('isAdmin');
Route::post('assignedroles/update', 'AssignedRolesController@update')->before('isAdmin');

Route::model('permissionrole', 'PermissionRole');
Route::get('permissionroles/edit/{permissionrole}','PermissionRolesController@edit')->before('isAdmin');
Route::post('permissionroles/update', 'PermissionRolesController@update')->before('isAdmin');

Route::get('assignedroles/destroy/{id}','AssignedRolesController@destroy')->before('isAdmin');
Route::get('roles/destroy/{id}','RolesController@destroy')->before('isAdmin');
Route::get('permissions/destroy/{id}','PermissionsController@destroy')->before('isAdmin');
Route::get('permissionroles/destroy/{id}','PermissionRolesController@destroy')->before('isAdmin');

