<?php

use Zizaco\Entrust\EntrustRole;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Role extends EntrustRole
{
	protected $fillable = ['name'];

	public function permissions(){
		return $this->hasMany('Permission');
	}
	public function permissionroles(){
		return $this->hasMany('PermissionRole');
	}
	public function assignedroles(){
		return $this->hasMany('AssignedRole');
	}
}