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
	Excel::selectSheets('Sheet1')->load('file.xlsx', function($reader) {
		    
		$results = $reader->all();
		
		DB::table('reach')->where('project_id','=',1)->delete();
		DB::table('project_data')->where('project_id','=',1)->delete();
		foreach ($results as $key => $value) {		
		$i = 1;$k = 1;
		$j = 1;
		$column_num = [];
		$column_num1 = [];
		$column_num['project_id'] = 1;
		$column_num1['project_id'] = 1;
			foreach($value as $key1 => $a){
				if($j < 17) {
					if($a!=NULL && $key1!='no_filter'){
						$column_num['column_'.$i] = $a;
					}if($key1 === 'no_filter'){
						$j = 12;
						$i = 12;
					}
					$i++;
				} else if($j > 16 && $j < 40) {
					if($a!=NULL){
						$column_num1['column_'.$k] = $a;
					}
					$k++;
				}
				$j++;
			}
			$id = DB::table('project_data')->insertGetId($column_num);
			$column_num1['project_data_id'] = $id;
			DB::table('reach')->insert($column_num1);
		}

		$count = 0;
		$headers_csv = $reader->first();
		DB::table('category_masters')->where('project_id','=',1)->delete();
		foreach ($headers_csv as $key => $value) {
			if($count < 12 && $key != 'no_filter'){
				DB::table('category_masters')->insert(['project_id' => 1,'name' => $key]);
			}
			$count++;
			if($key == 'no_filter') {
				break;
			}
			
		}

	})->get();	

	Excel::selectSheets('Sheet2')->load('file.xlsx', function($reader) {
		    
		$results = $reader->all();
		DB::table('scenarios')->where('project_id','=',1)->delete();
		foreach ($results as $key => $value) {			
			DB::table('scenarios')->insert(['project_id' => 1,'value' => $value->value]);
		}	
	})->get();
		
	return View::make('homepage');
});
Route::get('simulator/index', 'SimulatorController@index');

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

