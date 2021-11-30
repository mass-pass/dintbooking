<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ SITE_NAME}} | Log in</title>
  <link rel="shortcut icon" href="{{ $favicon }}">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{URL::to('/')}}/backend/bootstrap/css/bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{URL::to('/')}}/backend/dist/css/AdminLTE.min.css">
</head>
<body class="hold-transition login-page">

<div class="flash-container" class="ml-15">
  @if(Session::has('message'))
    <div class="alert {{ Session::get('alert-class') }} text-center" role="alert">
      <a href="#"  class="alert-close pull -right" data-dismiss="alert">&times;</a>
    {{ Session::get('message') }}
    </div>
  @endif
</div>

<div class="login-box">
  <div class="login-logo">
    <a href="{{ url('/') }}"><b>{{SITE_NAME}}</b></a>
  </div>
  <div class="login-box-body">
    <p class="login-box-msg">LOGIN TO <span class="loginto"><strong>{{ $site_name }}</strong></span></p>

    <form action="{{ url('admin/authenticate') }}" method="post" id="admin_login">
      {{ csrf_field() }}
      <div class="form-group has-feedback">
        <label for="username">Email</label>
        <input type="email" name="email" class="form-control" placeholder="Email" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control" placeholder="Password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
            </label>
          </div>
        </div>
        <div class="col-xs-4">
          <button type="submit" class="btn btn-dark btn-block btn-flat">Sign In</button>
        </div>
      </div>
    </form>
  </div>
</div>
</body>
</html>

