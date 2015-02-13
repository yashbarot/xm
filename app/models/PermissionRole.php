<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class PermissionRole extends Eloquent
{
	use SoftDeletingTrait;

	protected $table = 'permission_role';
	protected $fillable = ['permission_id', 'role_id'];

	protected $softDelete = true;
	protected $dates = ['deleted_at'];	

	public function permissions(){
		return $this->belongsTo('Permission');
	}
	public function roles(){
		return $this->belongsTo('Role');
	}
}