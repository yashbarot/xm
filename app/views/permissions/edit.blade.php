 <div class="row clearfix">
  <div class="col-md-12 column">
  <div class="panel panel-default">
  <div class="panel-heading">
  <h2><span class="grey">Edit Permission : </span>{{ $permission->name }}</h2>
  </div>
 {{ Form::open(['url'=> 'permissions/update', 'class'=>'form']) }}
 {{ Form::hidden('id', $permission->id)}}
  <div class="row"><div class="col-md-4">&nbsp;</div></div>
  <div class="row">
  <div class="col-md-4">{{ Form::label('name', 'Permission Name') }}</div>
  <div class="col-md-8">{{ Form::text('name', $permission->name, ['class' => 'form-control']) }}</div>
  </div>
  <div class="row"><div class="col-md-4">&nbsp;</div></div>
  <div class="row">
  <div class="col-md-4">{{ Form::label('displayname', 'Display Name') }}</div>
  <div class="col-md-8">{{ Form::text('displayname', $permission->display_name, ['class' => 'form-control']) }}</div>
  </div>  
  <div class="row"><div class="col-md-4">&nbsp;</div></div>
  <div class="row">
  <div class="col-md-4">{{ Form::submit('Save Permission', ['class' => 'btn btn-primary']) }}</div>
  <div class="col-md-8"></div>
  </div>
  {{ Form::close() }}
  </div>
  </div>
</div>