<?php

use Zizaco\Entrust\EntrustPermission;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Permission extends EntrustPermission
{
	use SoftDeletingTrait;	

	protected $fillable = ['name', 'display_name'];

	protected $softDelete = true;
	protected $dates = ['deleted_at'];

	public function roles(){
		return $this->hasMany('Role');
	}
	public function permissionroles(){
		return $this->hasMany('PermissionRole');
	}
}