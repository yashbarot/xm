 @extends('layout')
 @section('content')

 
 <form action="{{Request::root()}}/project_master/store_new_project_form" method="post" enctype="multipart/form-data">

    <div class="row"> 
         <div class="col-md-4"></div>
         <div class="col-md-4"  style="border:1px solid #d7d7d7;padding-bottom:10px;border-radius:5px;background:#fff;"> <h2>+ New Project</h2>
              <div class="row">
                 <div class="col-md-4">&nbsp;</div>
                 <div class="col-md-8"></div>
             </div>
             <div class="row">
                 <div class="col-md-12">{{ Form::select('project_master_id', $projects, ['class'=>'form-control','required']) }}</div>
             </div>
              <div class="row">
                 <div class="col-md-4">&nbsp;</div>
                 <div class="col-md-8"></div>
             </div>
             <div class="row">
                 <div class="col-md-12">{{ Form::file('file',['required']) }}</div>
             </div>
             <div class="row">
                 <div class="col-md-4">&nbsp;</div>
                 <div class="col-md-8"></div>
             </div>
             <div class="row">
                 <div class="col-md-4">{{ Form::submit('Post', ['class'=>'btn btn-primary']) }}
                 </div>
                 <div class="col-md-8"></div>
             </div>
         </div>
         <div class="col-md-4"></div>
    </div> 
 
 </form>

 @stop