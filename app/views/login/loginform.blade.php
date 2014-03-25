<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ParkCMS Login</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('admin_assets/css/main.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <style>
      body {
  padding-top: 40px;
  padding-bottom: 40px;
  background-color: #eee;
}

.form-signin {
  max-width: 330px;
  padding: 15px;
  margin: 0 auto;
  background: #fff;
  padding-bottom: 35px;
  border-radius: 5px;
}
.form-signin .form-signin-heading,
.form-signin .checkbox {
  margin-bottom: 10px;
}
.form-signin .checkbox {
  font-weight: normal;
}
.form-signin .form-control {
  position: relative;
  height: auto;
  -webkit-box-sizing: border-box;
     -moz-box-sizing: border-box;
          box-sizing: border-box;
  padding: 10px;
  font-size: 16px;
}
.form-signin .form-control:focus {
  z-index: 2;
}
.form-signin input[type="text"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}

    </style>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">
      <form action="{{ url('login/auth') }}" method="post" class="form-signin" role="form">
        <h2 class="form-signin-heading">Anmeldung</h2>
        @if (Session::has('auth_error'))
            <div class="alert alert-danger">{{ trans('auth.'.Session::get('auth_error')) }}</div>
        @endif
        @if (Session::has('auth_msg'))
            <div class="alert alert-success">{{ trans('auth.'.Session::get('auth_msg')) }}</div>
        @endif
        <input type="text" name="username" class="form-control" placeholder="Benutzername" required autofocus>
        <input type="password" name="password" class="form-control" placeholder="Passwort" required>
        <label class="checkbox">
          <input type="checkbox" name="remember-me" value="remember-me"> Angemeldet bleiben
        </label>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Anmelden</button>
      </form>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>
