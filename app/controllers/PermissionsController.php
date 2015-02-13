<?php

class PermissionsController extends \BaseController {

	protected $permission;

	public function __construct(Permission $permission){
		$this->permission = $permission;
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$permissions = $this->permission->where('deleted_at', NULL)->get();
		$permissions = $this->permission->paginate(5);
		return View::make('permissions.index')->with('permissions', $permissions);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('permissions.create');
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
		'name' => 'unique:permissions,name'
		];
		$validator = Validator::make($input,$rule);

		if($validator->passes()){			
		$input = Input::all();
		$this->permission->create($input);
		Session::flash('message', 'Permission has been created successfully.'); 
		Session::flash('alert-class', 'alert-success');		
		return Redirect::route('permissions.index');
		}
		else{
		Session::flash('message', 'Permission already exists.'); 
		Session::flash('alert-class', 'alert-danger');		
		return Redirect::route('permissions.index');			
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
		$permission = $this->permission->findOrFail(Input::get('id'));
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
		$permission = $this->permission->find($id);
		$permission->delete();
		Session::flash('message', 'Permission has been deleted successfully.'); 
		Session::flash('alert-class', 'alert-success');
        return Redirect::route('permissions.index');
	}


}
