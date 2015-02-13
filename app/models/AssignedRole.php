<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class AssignedRole extends Eloquent  {

	use SoftDeletingTrait;

    protected $fillable = array('user_id', 'role_id');

	protected $softDelete = true;
	protected $dates = ['deleted_at'];

    public function users() {
        return $this->belongsTo('User');
    }
    public function roles() {
    	return $this->belongsTo('Role');
    }
}