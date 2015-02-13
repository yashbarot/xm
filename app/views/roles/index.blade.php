 @extends('layout')
 @section('content')

 <div class="row clearfix">
        <div class="col-md-12 column">
            <div class="panel panel-default">
 <div class="panel-heading">
<div class="row">
 		<div class="col-md-10"><h2><span class="glyphicon glyphicon-list-alt"></span>&nbsp;<span class="grey">List of</span> Roles</h2></div>
 		<div class="col-md-2"><h4 class="right-side-add-link">{{ HTML::link('roles/create', '+ New Role') }}<h4></div>
 	</div>
 </div>
 @if ($roles->isEmpty()) 
 <p> Currently, there is no roles!</p>
  @else
<div class="table-responsive">
 <table class="table table-striped">
 <thead>
 <tr>

 <th>#</th>
 <th>Role</th>
 <th>Created At</th>
 <th>Updated At</th>
 <th>Actions</th>
 </tr>
 </thead>
 <tbody>
  @foreach($roles as $role)
 <tr>
 <td> {{ $role->id }} </td>
 <td> {{ $role->name }} </td>
 <td> {{ $role->created_at }} </td>
 <td> {{ $role->updated_at }} </td>
 <td>
 <a href="{{ action('RolesController@edit', $role->id) }}" class="glyphicon glyphicon-pencil edit-role-popup"></a>

 <a href="{{ action('RolesController@destroy', $role->id) }}" class="glyphicon glyphicon-remove"></a>
 </td>
 </tr>
  @endforeach 
 </tbody>
 </table>
 </div>
 @endif
 @stop