<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{url('adminlte123')}}/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{url('adminlte123')}}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{url('adminlte123')}}/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="{{url('adminlte123')}}/index2.html"><b>ABC</b>-Laravel8</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Đăng nhập</p>
        @if(session()->has('errors'))
        <div class="font-italic text-danger">{{session('errors')->first("message")}}</div>
        @endif

        <form action="{{route('admin.postlogin')}}" method="post">
          @csrf
          <div class="input-group mb-3">
            <input type="email" name="txtEmail" class="form-control" placeholder="Email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" name="txtPassword" class="form-control" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-7">
              <div class="icheck-primary">
                <input type="checkbox" id="remember" name="chkRemember">
                <label for="remember">
                  Nhớ phiên làm việc
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-5">
              <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="{{url('adminlte123')}}/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="{{url('adminlte123')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="{{url('adminlte123')}}/dist/js/adminlte.min.js"></script>
</body>

</html>
