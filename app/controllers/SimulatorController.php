<?php

class SimulatorController extends BaseController {

	
	public function index() {

		$category_names = DB::table('category_masters')->where('project_id','=',1)->lists('name');
        array_push($category_names,'Measure');
		$data_columns = [];
		for($i = 1;$i < sizeof($category_names); $i++){
			$temp = DB::table('project_data')->distinct()->lists('column_'.$i);
			array_push($data_columns,$temp);
		}
        
		$temp = DB::table('project_data')->distinct()->lists('column_14');
		array_push($data_columns,$temp);
		$data_columns_fix = DB::table('project_data')->distinct()->lists('column_13');
		$scenarios = DB::table('scenarios')->where('project_id','=',1)->get();
		$column_14 = DB::table('project_data')->distinct()->lists('column_14');
		return View::make('simulators.index',compact('category_names','data_columns','data_columns_fix','scenarios','column_14'));
	}

	public function doFiltering() {
		$category_names = Input::get('category_names');
		$size = sizeof($category_names);
		$extra = 'Select * from project_data where';
		for ($i=1; $i < $size; $i++) { 
			if($i==1){
				$extra .= " column_".$i." = '".$category_names[$i-1]."'"; 
			}else {
				$extra .= " AND column_".$i." = '".$category_names[$i-1]."'"; 
			}
		}
		$extra .= " AND column_14 = '".$category_names[$size-1]."'";
		$media_type = DB::table('project_data')->distinct()->lists('column_13');
		$data = [];
		$temp_id = [];
		foreach($media_type as $key => $value){        	
			$temp = $extra;
			$temp .= " AND column_13 = '".$value."'"; 
			$results = DB::select(DB::raw($temp));
			array_push($temp_id, $results[0]->id);
			array_push($data, $results[0]);
		}	        	
		$i = 0;	
		$temp_all_data = [];
		foreach ($temp_id as $key => $value) {
			$all_data = [];
			$temp_data = DB::table('reach')->where('project_data_id','=',$value)->first();
			array_push($all_data,$temp_data);
			$temp_data = DB::table('frequency')->where('project_data_id','=',$value)->first();
			array_push($all_data,$temp_data);
			$temp_data = DB::table('grp')->where('project_data_id','=',$value)->first();
			array_push($all_data,$temp_data);
			$temp_data = DB::table('media')->where('project_data_id','=',$value)->first();
			array_push($all_data,$temp_data);
			$temp_data = DB::table('contribution')->where('project_data_id','=',$value)->first();
			array_push($all_data,$temp_data);
			$temp_all_data[$media_type[$i]] = $all_data;
			$i++;
		}
		return json_encode($temp_all_data);
	}
}