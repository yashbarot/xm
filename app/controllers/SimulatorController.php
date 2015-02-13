<?php

class SimulatorController extends BaseController {

	
	public function index()
	{
		$category_names = DB::table('category_masters')->where('project_id','=',1)->lists('name');
		for($i=1;$i<=sizeof($category_names);$i++){
			$data_columns[$i] = DB::table('project_data')->distinct()->lists('column_'.$i);
		}

		$data_columns_fix[$i] = DB::table('project_data')->distinct()->lists('column_13');
		$scenarios = DB::table('scenarios')->where('project_id','=',1)->get();
		return View::make('simulators.index',compact('category_names','data_columns','data_columns_fix','scenarios'));
	}

}