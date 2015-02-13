
 @extends('layout')
 @section('content')
 <?php $user = Auth::user(); ?>
@if($user->hasRole('admin'))
 {{ Form::open(['route'=> 'permissionroles.store', 'class' => 'form']) }}

    <div class="row"> 
         <div class="col-md-4"></div>
         <div class="col-md-4"  style="border:1px solid #d7d7d7;padding-bottom:10px;border-radius:5px;background:#fff;"> <h2>Add Permission</h2>
              <div class="row">
                 <div class="col-md-4">&nbsp;</div>
                 <div class="col-md-8"></div>
             </div>
             <div class="row">
                 <div class="col-md-4">{{ Form::label('role','Role') }}</div>
                 <div class="col-md-8">{{ Form::select('role_id', $roles, null,['class'=>'form-control','required']) }}</div>
             </div>             
              <div class="row">
                 <div class="col-md-4">&nbsp;</div>
                 <div class="col-md-8"></div>
             </div>
            <div class="row">
                 <div class="col-md-4">{{ Form::label('permission','Permission') }}</div>
                <div class="col-md-8">{{ Form::select('permission_id', $permissions,null,['class'=>'form-control','required']) }}</div> 
             </div>
                          
              <div class="row">
                 <div class="col-md-4">&nbsp;</div>
                 <div class="col-md-8"></div>
             </div>             
             <div class="row">
                 <div class="col-md-4">{{ Form::submit('Add Permission', ['class'=>'btn btn-primary']) }}</div>
                 <div class="col-md-8"></div>
             </div>
         </div>
         <div class="col-md-4"></div>
    </div> 
 
 {{ Form::close() }}
@else
 <center><h1 style="color:red;">{{ "Opps!! Access Denied" }}</h1></center>
@endif 
 @stop 
