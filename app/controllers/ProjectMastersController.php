<?php

class ProjectMastersController extends \BaseController {

	protected $project_master;

	public function __construct(ProjectMaster $project_master){
		$this->project_master= $project_master;
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$projects = $this->project_master->get();
	
		return View::make('projectmasters.index')->with('projects', $projects);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		
		return View::make('projectmasters.create');
	}

	public function new_project_form()
	{
		$projects = $this->project_master->lists('name','id');
		return View::make('projectmasters.new_project_form',compact('projects'));
	}

	public function assign_project_form(){
		$projects = $this->project_master->lists('name','id');
		$users = User::lists('username','id');
		return View::make('projectmasters.assign_project_form',compact('projects','users'));
	}
	public function store_assign_project() {
		$project_id = Input::get('project_master_id');
		$user_id = Input::get('user_id');
		DB::table('project_masters')->where('id','=',$project_id)->update(['users_id' => $user_id]);
    	Session::flash('message', 'Project has been assigned successfully.'); 
		Session::flash('alert-class', 'alert-success');		
		return Redirect::route('project_master.index');

	}

	public function logo_upload_form(){
		$projects = $this->project_master->lists('name','id');
		return View::make('projectmasters.logo_upload_form',compact('projects'));
	}
	public function store_logo() {
		$file = Input::file('file');
		$id = Input::get('project_master_id');
		if ($file)
		{
		$destinationPath = 'logos/';
        $upload = $file->move($destinationPath,$file->getClientOriginalName());

        $file_path = $destinationPath.$file->getClientOriginalName();
	        if($upload){
	        	DB::table('logos')->insert(['project_master_id' => $id,'path' => $file_path]);
	        	Session::flash('message', 'Project logo has been uploaded successfully.'); 
				Session::flash('alert-class', 'alert-success');		
				return Redirect::route('project_master.index');
			}
			else{
				Session::flash('message', 'Problem with logo upload'); 
				Session::flash('alert-class', 'alert-danger');		
				return Redirect::route('project_master.logo_upload_form');			
			}
        }
	}

	public function pdf_upload_form(){
		$projects = $this->project_master->lists('name','id');
		return View::make('projectmasters.pdf_upload_form',compact('projects'));
	}
	public function store_pdf() {
		$file = Input::file('file');
		$id = Input::get('project_master_id');
		if ($file)
		{
		$destinationPath = 'pdfs/';
        $upload = $file->move($destinationPath,$file->getClientOriginalName());

        $file_path = $destinationPath.$file->getClientOriginalName();
	        if($upload){
	        	DB::table('pdfs')->insert(['project_master_id' => $id,'path' => $file_path]);
	        	Session::flash('message', 'Project logo has been uploaded successfully.'); 
				Session::flash('alert-class', 'alert-success');		
				return Redirect::route('project_master.index');
			}
			else{
				Session::flash('message', 'Problem with logo upload'); 
				Session::flash('alert-class', 'alert-danger');		
				return Redirect::route('project_master.pdf_upload_form');			
			}
        }
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$rule = [	
		'name' => 'unique:project_masters,name'
		];
		$validator = Validator::make($input,$rule);

		if($validator->passes()){			
		
		$this->project_master->create($input);
		Session::flash('message', 'Project has been created successfully.'); 
		Session::flash('alert-class', 'alert-success');		
		return Redirect::route('project_master.index');
		}
		else{
		Session::flash('message', 'Projectalready exists.'); 
		Session::flash('alert-class', 'alert-danger');		
		return Redirect::route('project_master.index');			
		}
	}

	public function store_new_project_form() {
		
		$file = Input::file('file');
		if ($file)
		{
		$destinationPath = 'sheets/';
        $upload = $file->move($destinationPath,$file->getClientOriginalName());

        $file_path = $destinationPath.$file->getClientOriginalName();
        if($upload){
        	Excel::selectSheets('Sheet1')->load($file_path, function($reader) {
		    
		$results = $reader->all();
		$project_master_id = Input::get('project_master_id');
		DB::table('reach')->where('project_id','=',$project_master_id)->delete();
		DB::table('frequency')->where('project_id','=',$project_master_id)->delete();
		DB::table('grp')->where('project_id','=',$project_master_id)->delete();
		DB::table('media')->where('project_id','=',$project_master_id)->delete();
		DB::table('contribution')->where('project_id','=',$project_master_id)->delete();
		DB::table('project_data')->where('project_id','=',$project_master_id)->delete();

		foreach ($results as $key => $value) {		
		$i = 1;
		$j = 1;
		$k = 1;
		$l = 1;
		$m = 1;
		$n = 1;
		$o = 1;
		$column_num 	= [];
		$reach 			= [];
		$frequency 		= [];
		$grp 			= [];
		$media 			= [];
		$contribution 	= [];
		$column_num['project_id'] = $project_master_id;
		$reach['project_id'] = $project_master_id;
		$frequency['project_id'] = $project_master_id;
		$grp['project_id'] = $project_master_id;
		$media['project_id'] = $project_master_id;
		$contribution['project_id'] = $project_master_id;
	
			foreach($value as $key1 => $a){
				if($j < 17) {
					if($a!=NULL && $key1!='no filter'){
						$column_num['column_'.$i] = $a;
					}if($key1 === 'no filter'){
						$j = 12;
						$i = 12;
					}
					$i++;
				} else if($j > 16 && $j < 40) {
					if($a!=NULL){
						$reach['column_'.$k] = $a;
					} else {
						$reach['column_'.$k] = 0;
					}
					$k++;
				} else if($j > 39 && $j < 63) {
					if($a!=NULL){
						$frequency['column_'.$l] = $a;
					} else {
						$frequency['column_'.$l] = 0;
					}
					$l++;
				} else if($j > 62 && $j < 86) {
					if($a!=NULL){
						$grp['column_'.$m] = $a;
					} else {
						$grp['column_'.$m] = 0;
					}
					$m++;
				} else if($j > 85 && $j < 109) {
					if($a!=NULL){
						$media['column_'.$n] = $a;
					} else {
						$media['column_'.$n] = 0;
					}
					$n++;
				} else if($j > 108 && $j < 132) {
					if($a!=NULL){
						$contribution['column_'.$o] = $a;
					} else {
						$contribution['column_'.$o] = 0;
					}
					$o++;
				} 
				$j++;
			}
			$id = DB::table('project_data')->insertGetId($column_num);

			
			$reach['project_data_id'] 			= $id;
			$frequency['project_data_id'] 		= $id;
			$grp['project_data_id'] 			= $id;
			$media['project_data_id'] 			= $id;
			$contribution['project_data_id'] 	= $id;
	
			
			DB::table('reach')->insert($reach);
			DB::table('frequency')->insert($frequency);
			DB::table('grp')->insert($grp);
			DB::table('media')->insert($media);
			DB::table('contribution')->insert($contribution);
		}


		$count = 0;
		$headers_csv = $reader->first();
		DB::table('category_masters')->where('project_id','=',$project_master_id)->delete();
		foreach ($headers_csv as $key => $value) {
			if($count < 12 && $key != 'no filter'){
				DB::table('category_masters')->insert(['project_id' => $project_master_id,'name' => $key]);
			}
			$count++;
			if($key == 'no filter') {
				break;
			}
			
		}

	})->get();	

	Excel::selectSheets('Sheet2')->load($file_path, function($reader) {
		$project_master_id = Input::get('project_master_id');    
		$results = $reader->all();
		DB::table('scenarios')->where('project_id','=',$project_master_id)->delete();
		foreach ($results as $key => $value) {			
			DB::table('scenarios')->insert(['project_id' => $project_master_id,'value' => $value->value]);
		}	
	})->get();
		
		Session::flash('message', 'Data has been imported successfully.'); 
		Session::flash('alert-class', 'alert-success');		
		return Redirect::route('project_master.index');
	
        }
       }
	}
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Permission $permission)
	{
		return View::make('permissions.edit', compact('permission'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update()
	{
		$permission = $this->project_master->findOrFail(Input::get('id'));
		$input = Input::all();
		$permission->name = Input::get('name');
		$permission->display_name = Input::get('displayname');
		$permission->save();
		Session::flash('message', 'Permission has been updated successfully.'); 
		Session::flash('alert-class', 'alert-success');		
		return Redirect::route('permissions.index');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$permission = $this->project_master->find($id);
		$permission->delete();
		Session::flash('message', 'Permission has been deleted successfully.'); 
		Session::flash('alert-class', 'alert-success');
        return Redirect::route('permissions.index');
	}


}
