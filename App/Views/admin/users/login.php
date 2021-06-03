<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in (v2)</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo assets('admin/plugins/fontawesome-free/css/all.min.css') ?>">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo assets('/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo assets('/admin/dist/css/adminlte.min.css') ?>">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../../index2.html" class="h1"><b>Admin</b>LTE</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="<?php echo url('/admin/login/submit'); ?>" method="post" id="login-form">

        <!-- strat div show errors -->
        <div class="" style="font-weight: bold;" id="login-results"></div>
        <!-- end div show errors -->

        <div class="input-group mb-3">
          <input type="email" name="email" required class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" required class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" name="remember" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
<!-- 
      <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="register.html" class="text-center">Register a new membership</a>
      </p> -->
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?php echo assets('/admin/plugins/jquery/jquery.min.js') ?>"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo assets('/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo assets('/admin/dist/js/adminlte.min.js') ?>"></script>

<script>
  $(function () {
    // protect from don't submit it more than one in same time
    var flag = false;

    // div show errors 
    loginResults = $('#login-results');

    // Start Submit form
    $('#login-form').on('submit', function(e) {
      e.preventDefault();

      if(flag == true){
        return false;
      }

      form = $(this);
      requestUrl = form.attr('action');
      requestMethod = form.attr('method');
      requestData  = form.serialize();

      $.ajax({
        url: requestUrl,
        type: requestMethod,
        data: requestData,
        dataType: 'json',
        beforeSend: function () {
          flag = true;
          $('button').attr('disabled', true);
          loginResults.removeClass().addClass('alert alert-info').html('Logging...');

        },
        success: function (results) {
          if(results.errors) {
            loginResults.removeClass().addClass('alert alert-danger').html(results.errors);
            flag = false;
            $('button').removeAttr('disabled');

          } else if (results.success) {
            loginResults.removeClass().addClass('alert alert-success').html(results.success);

            setTimeout(function () {

              if(results.redirect) {
                window.location.href = results.redirect;
              }

            }, 2000);
            
          }
        }

      });

    });

  }); 
</script>
</body>
</html>
