@extends('layout')
@section('content')
	<div class="row clearfix">
	<div class="col-md-12 column">
	<div class="panel panel-default">
	<div class="panel-heading">
	<div class="row">
	<div class="col-md-9"><h2><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Project Master</h2></div>
	<div class="col-md-3"><h4 class="right-side-add-link">{{ HTML::link('project_master/create', '+ New Project') }}<h4></div>
	</div>
	</div>
	@if ($projects->isEmpty()) 
	<p> Currently, there is no projects!</p>
	@else
	<div class="table-responsive">
	<table class="table table-striped">
	<thead>
	<tr>
	<th>#</th>
	<th>Project Name</th>
	<th>Created At</th>
	<th>Updated At</th>
	<th>Actions</th>
	</tr>
	</thead>
	<tbody>
	@foreach($projects as $project)
	<tr>
	<td> {{ $project->id }} </td>
	<td> {{ $project->name }} </td>
	<td> {{ $project->created_at }} </td>
	<td> {{ $project->updated_at }} </td>
	<td>
	<a href="" class="glyphicon glyphicon-pencil edit-project-popup"></a>
	<a href="" class="glyphicon glyphicon-remove"></a>
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