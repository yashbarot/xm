 @extends('layout')
 @section('content')

 {{ Form::open(['route'=> 'project_master.store', 'class' => 'form']) }}

    <div class="row"> 
         <div class="col-md-4"></div>
         <div class="col-md-4"  style="border:1px solid #d7d7d7;padding-bottom:10px;border-radius:5px;background:#fff;"> <h2>+ New Project</h2>
              <div class="row">
                 <div class="col-md-4">&nbsp;</div>
                 <div class="col-md-8"></div>
             </div>
             <div class="row">
                 <div class="col-md-12">{{ Form::text('name', null, ['class'=>'form-control','required','placeholder' => 'Name of project']) }}</div>
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
 
 {{ Form::close() }}

 @stop