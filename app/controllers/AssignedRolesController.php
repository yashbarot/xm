<?php

class AssignedRolesController extends \BaseController {

	protected $assigned_roles;
	public function __construct(AssignedRole $assigned_roles){
		$this->assignedrole = $assigned_roles;
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$assignedroles = $this->assignedrole->where('deleted_at')->get();
		$users = User::all();
		$roles = Role::all();
		return View::make('assignedroles.index')->with('assignedroles', $assignedroles)->with('users', $users)->with('roles', $roles);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$users = User::lists('username','id');
		$roles = Role::lists('name', 'id');
		return View::make('assignedroles.create')->with('users', $users)->with('roles', $roles);
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
					'user_id' => 'unique:assigned_roles,user_id,role_id'

		];
		$validator = Validator::make($input,$rule);

		if($validator->passes()){
		$input = Input::all();
		$this->assignedrole->create($input);
		return Redirect::route('assignedroles.index');
		}
		else{
		Session::flash('message', 'Assigned Roles already exists.'); 
		Session::flash('alert-class', 'alert-danger'); 			
		return Redirect::route('assignedroles.index');	
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
	public function edit(AssignedRole $assignedrole)
	{
		$user = User::lists('username', 'id');
		$role = Role::lists('name', 'id');
		return View::make('assignedroles.edit', compact('assignedrole'))->with('user', $user)->with('role', $role);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update()
	{
		$assignedrole = $this->assignedrole->findOrFail(Input::get('id'));
		$assignedrole->user_id = Input::get('user_id');
		$assignedrole->role_id = Input::get('role_id');
		$assignedrole->save();
		Session::flash('message', 'Category has been updated successfully.'); 
		Session::flash('alert-class', 'alert-success');   
		return Redirect::route('assignedroles.index');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$assignedrole = $this->assignedrole->find($id);
		$assignedrole->delete();
		Session::flash('message', 'Assigned Role has been deleted successfully.'); 
		Session::flash('alert-class', 'alert-success');
        return Redirect::route('assignedroles.index');
	}


}
