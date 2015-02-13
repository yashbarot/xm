@extends('layout')
@section('content')
  {{ Form::open(['url'=> 'assignedroles/update', 'class'=>'form']) }}
  {{ Form::hidden('id', $assignedrole->id)}}
    <div class="row"> 
    <div class="col-md-4"></div>
    <div class="col-md-4"  style="border:1px solid #d7d7d7;padding-bottom:10px;border-radius:5px;background:#fff;"> <h2>Assign Roles</h2>
    <div class="row">
    <div class="col-md-4">&nbsp;</div>
    <div class="col-md-8"></div>
    </div>
    <div class="row">
    <div class="col-md-4">{{ Form::label('user','User') }}</div>
    <div class="col-md-8">{{ Form::select('user_id', $user, $assignedrole->user_id,['class'=>'form-control','required']) }}</div> 
    </div>             
    <div class="row">
    <div class="col-md-4">&nbsp;</div>
    <div class="col-md-8"></div>
    </div>
    <div class="row">
    <div class="col-md-4">{{ Form::label('role','Role') }}</div>
    <div class="col-md-8">{{ Form::select('role_id', $role, $assignedrole->role_id,['class'=>'form-control','required']) }}</div> 
    </div>                   
    <div class="row">
    <div class="col-md-4">&nbsp;</div>
    <div class="col-md-8"></div>
    </div>             
    <div class="row">
    <div class="col-md-4">{{ Form::submit('Update Assigned Role', ['class'=>'btn btn-primary']) }}</div>
    <div class="col-md-8"></div>
    </div>
    </div>
    <div class="col-md-4"></div>
    </div> 
  {{ Form::close() }}
@stop