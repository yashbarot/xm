<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name=viewport content="width=device-width, initial-scale=1">
<title>Laravel</title>
<head>  
  <!-- <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootswatch/3.3.0/yeti/bootstrap.min.css"> -->
  {{ HTML::style('css/bootstrap.min.css'); }}
  {{ HTML::style('css/style.css'); }}
  {{ HTML::script('js/jquery.min.js') }}
  {{ HTML::script('js/bootstrap.min.js') }}
</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="margin-bottom:0px;"> 

  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Brand</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        @if(!Auth::check())
      
      <li>
      
      <a href="{{Request::root()}}/users/create"><i class="fa fa-user"><i class="fa fa-plus fa-xs" style="font-size: 8px;vertical-align: top;"></i></i>&nbsp;Register</a>
      </li> 

      <li>&nbsp;</li> 
      
      <li style="margin-right:15px;">
      
      <a href="{{Request::root()}}/users/login"><i class = 'fa fa-sign-in'></i>&nbsp;Login</a>
      </li>   
      
      @else
        <li>{{ HTML::link('users/logout', 'Logout') }}</li>
      @endif  
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
      </ul>
    
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav> 
<div class="container main_container">
  @if(Session::has('message'))
  <div class="alert {{ Session::get('alert-class', 'alert-info') }}" role="alert">
  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
  {{ Session::get('message') }}
  </div>
  @endif
  @yield('content') 
</div>

</body>
</html>