 <div class="row clearfix">
  <div class="col-md-12 column">
  <div class="panel panel-default">
  <div class="panel-heading">
  <h2><span class="grey">Edit Role : </span>{{ $role->name }}</h2>
  </div>
 {{ Form::open(['url'=> 'roles/update', 'class'=>'form']) }}
 {{ Form::hidden('id', $role->id)}}
  <div class="row"><div class="col-md-4">&nbsp;</div></div>
  <div class="row">
  <div class="col-md-4">{{ Form::label('name', 'Role Name') }}</div>
  <div class="col-md-8">{{ Form::text('name', $role->name, ['class' => 'form-control']) }}</div>
  </div>
  <div class="row"><div class="col-md-4">&nbsp;</div></div>
  <div class="row">
  <div class="col-md-4">{{ Form::submit('Save Role', ['class' => 'btn btn-primary']) }}</div>
  <div class="col-md-8"></div>
  </div>
  {{ Form::close() }}
  </div>
  </div>
</div>