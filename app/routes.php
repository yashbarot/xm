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
		DB::table('project_data')->where('project_id','=',1)->delete();
		DB::table('reach')->where('project_id','=',1)->delete();
		foreach ($results as $key => $value) {		
		$i = 1;$k = 1;
		$j = 1;
		$column_num = [];
		$column_num1 = [];
		$column_num['project_id'] = 1;
		$column_num1['project_id'] = 1;
			foreach($value as $a){
				if($j < 17) {
					if($a!=NULL){
						$column_num['column_'.$i] = $a;
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
			DB::table('project_data')->insert($column_num);
			DB::table('reach')->insert($column_num1);
		}	
	})->get();	
/*
	Excel::selectSheets('Sheet2')->load('file.xlsx', function($reader) {
		    
		$results = $reader->all();
		DB::table('scenarios')->where('project_id','=',1)->delete();
		foreach ($results as $key => $value) {			
			DB::table('scenarios')->insert(['project_id' => 1,'value' => $value->value]);
		}	
	})->get();*/
		
	return View::make('homepage');
});
//

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
