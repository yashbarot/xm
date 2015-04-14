@extends('layout')
@section('content')
<div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4" class="login-box">
        <div class="panel panel-default" style="padding:10px;">
        <div class="panel-heading box_heading">
            <h2>Reset Password</h2> </div>

{{ Form::open(['route'=> 'users.updatepassword', 'class' => 'form']) }}
    
    <div class="form-group">
        <label for="password">{{{ Lang::get('confide::confide.password') }}}</label>
        <input class="form-control" placeholder="{{{ Lang::get('confide::confide.password') }}}" type="password" name="password" id="password">
    </div>
    <div class="form-group">
        <label for="password_confirmation">{{{ Lang::get('confide::confide.password_confirmation') }}}</label>
        <input class="form-control" placeholder="{{{ Lang::get('confide::confide.password_confirmation') }}}" type="password" name="password_confirmation" id="password_confirmation">
    </div>

    @if (Session::get('error'))
        <div class="alert alert-error alert-danger">{{{ Session::get('error') }}}</div>
    @endif

    @if (Session::get('notice'))
        <div class="alert">{{{ Session::get('notice') }}}</div>
    @endif

    <div class="form-actions form-group">
        <button type="submit" class="btn btn-primary">{{{ Lang::get('confide::confide.forgot.submit') }}}</button>
    </div>
</form>
</div>
</div>
@stop