@extends('layout')
@section('content')
	<div class="row clearfix">
	<div class="col-md-12 column">
	<div class="panel panel-default">
	<div class="panel-heading">
	<div class="row">
	<div class="col-md-9"><h2><span class="glyphicon glyphicon-list-alt"></span>&nbsp;<span class="grey">List of</span> Permission Roles</h2></div>
	<div class="col-md-3"><h4 class="right-side-add-link">{{ HTML::link('permissionroles/create', '+ New Permission Roles') }}<h4></div>
	</div>
	</div>

	@if ($permissionroles->isEmpty()) 
	<p> Currently, there is no permission roles!</p>
	@else
	<div class="table-responsive">
	<table class="table table-striped">
	<thead>
	<tr>
	<th>#</th>
	<th>Roles</th>
	<th>Permissions</th>
	<th>Actions</th>
	</tr>
	</thead>
	<tbody>
	
<!-- 	@foreach($roles as $role)
	{{ $role->name }}
	@endforeach
	@foreach($permissions as $permission)
	{{ $permission->name }}
	@endforeach
 -->
	@foreach($permissionroles as $permissionrole)
	<tr>
	<td> {{ $permissionrole->id }} </td>
	<td> {{ $permissionrole->role_id }}
	</td>
	<td> {{ $permissionrole->permission_id }} </td>
	<td>
	<a href="{{ action('PermissionRolesController@edit', $permissionrole->id) }}" class="glyphicon glyphicon-pencil"></a>
	<a href="{{ action('PermissionRolesController@destroy', $permissionrole->id) }}" class="glyphicon glyphicon-remove"></a>
	</td>
	</tr>
	@endforeach 
	</tbody>
	</table>
	</div>
	@endif 
	</div>
	</div>
	</div>
@stop