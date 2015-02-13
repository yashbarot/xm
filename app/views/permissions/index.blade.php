 @extends('layout')
 @section('content')

 <div class="row clearfix">
        <div class="col-md-12 column">
            <div class="panel panel-default">
 <div class="panel-heading">
<div class="row">
 		<div class="col-md-10"><h2><span class="glyphicon glyphicon-list-alt"></span>&nbsp;<span class="grey">List of</span> Permissions</h2></div>
 		<div class="col-md-2"><h4 class="right-side-add-link">{{ HTML::link('permissions/create', '+ New Permission') }}<h4></div>
 	</div>
 </div>
 @if ($permissions->isEmpty()) 
 <p> Currently, there is no permissions!</p>
  @else
<div class="table-responsive">
 <table class="table table-striped">
 <thead>
 <tr>

 <th>#</th>
 <th>Permission</th>
 <th>Display Name</th>
 <th>Created At</th>
 <th>Updated At</th>
 <th>Actions</th>
 </tr>
 </thead>
 <tbody>
  @foreach($permissions as $permission)
 <tr>
 <td> {{ $permission->id }} </td>
 <td> {{ $permission->name }} </td>
 <td> {{ $permission->display_name }} </td>
 <td> {{ $permission->created_at }} </td>
 <td> {{ $permission->updated_at }} </td>
 <td>
 <a href="{{ action('PermissionsController@edit', $permission->id) }}" class="glyphicon glyphicon-pencil edit-permission-popup"></a>
 <a href="{{ action('PermissionsController@destroy', $permission->id) }}" class="glyphicon glyphicon-remove"></a>
 </td>
 </tr>
  @endforeach 
 </tbody>
 </table>
 </div>
 {{ $permissions->links() }}
 @endif
 @stop