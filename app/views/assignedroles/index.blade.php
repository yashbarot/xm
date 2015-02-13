 @extends('layout')
 @section('content')

 <div class="row clearfix">
        <div class="col-md-12 column">
            <div class="panel panel-default">
 <div class="panel-heading">
<div class="row">
 		<div class="col-md-10"><h2><span class="glyphicon glyphicon-list-alt"></span>&nbsp;<span class="grey">List of</span> Assigned Roles</h2></div>
 		<div class="col-md-2"><h4 class="right-side-add-link">{{ HTML::link('assignedroles/create', '+ Assign Role') }}<h4></div>
 	</div>
 </div>

 @if ($assignedroles->isEmpty()) 
 <p> Currently, there is no permission roles!</p>
  @else
<div class="table-responsive">
 <table class="table table-striped">
 <thead>
 <tr>

 <th>#</th>
 <th>Users</th>
 <th>Roles</th>
 <th>Actions</th>
 </tr>
 </thead>
 <tbody>
  @foreach($assignedroles as $assignedrole)
 <tr>
 <td> {{ $assignedrole->id }} </td>
 <td> {{ $assignedrole->user_id }} </td>
 <td> {{ $assignedrole->role_id }} </td>
 <td>
 <a href="{{ action('AssignedRolesController@edit', $assignedrole->id) }}" class="glyphicon glyphicon-pencil"></a>

 <a href="{{ action('AssignedRolesController@destroy', $assignedrole->id) }}" class="glyphicon glyphicon-remove"></a>
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