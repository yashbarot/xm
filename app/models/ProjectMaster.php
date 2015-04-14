<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class ProjectMaster extends Eloquent  {
	
	use SoftDeletingTrait;
   	
   	protected $dates = ['deleted_at'];
   	protected $softDelete = true;

	protected $fillable = ['name'];
}