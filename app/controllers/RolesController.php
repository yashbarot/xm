<?php

class RolesController extends \BaseController {

	protected $role;

	public function __construct(Role $role) {
		$this->role = $role;
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $roles = $this->role->where('deleted_at')->get();
        return View::make('roles.index')->with('roles', $roles);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('roles.create');
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
			'name' => 'unique:roles,name'
			];
			$validator = Validator::make($input,$rule);

			if($validator->passes()){				
            $input = Input::all();
			$this->role->create($input);
			Session::flash('message', 'Role has been created successfully.'); 
			Session::flash('alert-class', 'alert-success'); 			
			return Redirect::route('roles.index');
			}
			else{
			Session::flash('message', 'Role already exists.'); 
			Session::flash('alert-class', 'alert-danger'); 			
			return Redirect::route('roles.index');				
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
	public function edit(Role $role)
	{
		return View::make('roles.edit', compact('role'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update()
	{
		$role = $this->role->findOrFail(Input::get('id'));
		$input = Input::all();
		$role->name = Input::get('name');
		$role->save();
		Session::flash('message', 'Role has been updated successfully.'); 
		Session::flash('alert-class', 'alert-success'); 			
		return Redirect::route('roles.index');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$role = $this->role->find($id);
		$role->delete();
		Session::flash('message', 'Role has been deleted successfully.'); 
		Session::flash('alert-class', 'alert-success');
        return Redirect::route('roles.index');		
	}


}
