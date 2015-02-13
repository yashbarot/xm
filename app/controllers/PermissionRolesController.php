<?php

class PermissionRolesController extends \BaseController {

	protected $permission_role;

	public function __construct(PermissionRole $permission_role){
		$this->permission_role = $permission_role;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$permissionroles = $this->permission_role->where('deleted_at', NULL)->get();
		$permissions = Permission::where('deleted_at', NULL)->get();
		// dd($permissions);
		$roles = Role::all();
		 // echo "<pre>";
		 // var_dump($permissions);
		 // echo "</pre>";
		return View::make('permissionroles.index')->with('permissionroles', $permissionroles)->with('permissions', $permissions)->with('roles', $roles);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$permissions = Permission::lists('name','id');
		$roles = Role::lists('name', 'id');
		return View::make('permissionroles.create')->with('permissions', $permissions)->with('roles', $roles);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
/*		$rule = [
			'permission_id' => 'unique:permission_role, permission_id'
		];
		
		$validator = Validator::make($input,$rule);

		if($validator->passes()){*/		
			$input = Input::all();
			$this->permission_role->create($input);
			Session::flash('message', 'Permission Role has been created successfully.'); 
			Session::flash('alert-class', 'alert-success');		
			return Redirect::route('permissionroles.index');
/*		}
		else{
			Session::flash('message', 'Permission Role already exists.'); 
			Session::flash('alert-class', 'alert-danger');		
			return Redirect::route('permissionroles.index');	
		}*/
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
	public function edit(PermissionRole $permissionrole)
	{
		$role = Role::lists('name', 'id');
		$permission = Permission::lists('name', 'id');	
		return View::make('permissionroles.edit', compact('permissionrole'))->with('role', $role)->with('permission', $permission);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update()
	{
		$permissionrole = $this->permission_role->findOrFail(Input::get('id'));
		$permissionrole->role_id = Input::get('role_id');
		$permissionrole->permission_id = Input::get('permission_id');
		$permissionrole->save();
		Session::flash('message', 'Permission Role has been updated successfully.'); 
		Session::flash('alert-class', 'alert-success');		
		return Redirect::route('permissionroles.index');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$permissionrole = $this->permission_role->find($id);
		$permissionrole->delete();
		Session::flash('message', 'Permission Role has been deleted successfully.'); 
		Session::flash('alert-class', 'alert-success');
        return Redirect::route('permissionroles.index');
	}


}
